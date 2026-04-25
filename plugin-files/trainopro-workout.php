<?php
/**
 * Plugin Name: TrainoPro Workout Manager
 * Description: Manage workout plans, assign to users, log sessions (sets/reps/weight/photos) and link metrics to the dashboard.
 * Version: 1.0.0
 * Author: TrainoPro
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TP_VERSION', '1.0.0' );
define( 'TP_PATH', plugin_dir_path( __FILE__ ) );
define( 'TP_URL',  plugin_dir_url( __FILE__ ) );

/* ─────────────────────────────────────────
   ACTIVATION — create tables
───────────────────────────────────────── */
register_activation_hook( __FILE__, 'tp_activate' );
function tp_activate() {
    global $wpdb;
    $charset = $wpdb->get_charset_collate();

    // Workout logs table
    $wpdb->query( "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}tp_workout_logs (
        id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id       BIGINT UNSIGNED NOT NULL,
        plan_id       BIGINT UNSIGNED NOT NULL DEFAULT 0,
        log_date      DATE NOT NULL,
        muscle_group  VARCHAR(100) DEFAULT '',
        exercise      VARCHAR(200) DEFAULT '',
        sets_done     INT DEFAULT 0,
        reps_done     INT DEFAULT 0,
        weight_start  FLOAT DEFAULT 0,
        weight_end    FLOAT DEFAULT 0,
        calories_burn INT DEFAULT 0,
        duration_min  INT DEFAULT 0,
        notes         TEXT DEFAULT '',
        photo_url     VARCHAR(500) DEFAULT '',
        created_at    DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset;" );

    // User profiles table
    $wpdb->query( "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}tp_user_profiles (
        id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id         BIGINT UNSIGNED NOT NULL UNIQUE,
        full_name       VARCHAR(200) DEFAULT '',
        email           VARCHAR(200) DEFAULT '',
        mobile          VARCHAR(30)  DEFAULT '',
        age             INT DEFAULT 0,
        gender          VARCHAR(20)  DEFAULT '',
        blood_group     VARCHAR(10)  DEFAULT '',
        goal            VARCHAR(100) DEFAULT '',
        coach           VARCHAR(100) DEFAULT '',
        profile_photo   VARCHAR(500) DEFAULT '',
        current_weight  FLOAT DEFAULT 0,
        ideal_weight    FLOAT DEFAULT 0,
        health_notes    TEXT DEFAULT '',
        created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) $charset;" );

    // Workout plans table
    $wpdb->query( "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}tp_workout_plans (
        id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        plan_name     VARCHAR(200) NOT NULL,
        muscle_group  VARCHAR(100) DEFAULT '',
        exercises     LONGTEXT     DEFAULT '',
        assigned_user BIGINT UNSIGNED DEFAULT 0,
        duration_min  INT DEFAULT 45,
        calories_est  INT DEFAULT 300,
        difficulty    VARCHAR(20)  DEFAULT 'Medium',
        created_by    BIGINT UNSIGNED DEFAULT 0,
        created_at    DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset;" );

    // Daily metrics table (Water, Nutrition)
    $wpdb->query( "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}tp_daily_metrics (
        id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id       BIGINT UNSIGNED NOT NULL,
        metric_type   VARCHAR(50) NOT NULL, -- 'water', 'meal'
        metric_value  FLOAT DEFAULT 0,      -- ml for water, kcal for meal
        protein       FLOAT DEFAULT 0,
        carbs         FLOAT DEFAULT 0,
        fat           FLOAT DEFAULT 0,
        log_date      DATE NOT NULL,
        created_at    DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset;" );

    flush_rewrite_rules();
}

/* ─────────────────────────────────────────
   ADMIN MENU
───────────────────────────────────────── */
add_action( 'admin_menu', 'tp_admin_menu' );
function tp_admin_menu() {
    add_menu_page( 'TrainoPro', 'TrainoPro', 'manage_options', 'trainopro', 'tp_dashboard_page', 'dashicons-universal-access-alt', 25 );
    add_submenu_page( 'trainopro', 'Workout Plans',    'Workout Plans',    'manage_options', 'tp-plans',    'tp_plans_page' );
    add_submenu_page( 'trainopro', 'Workout Logs',     'Workout Logs',     'manage_options', 'tp-logs',     'tp_logs_page' );
    add_submenu_page( 'trainopro', 'User Profiles',    'User Profiles',    'manage_options', 'tp-profiles', 'tp_profiles_page' );
    add_submenu_page( 'trainopro', 'Add Workout Plan', 'Add Workout Plan', 'manage_options', 'tp-add-plan', 'tp_add_plan_page' );
}

/* ── SHARED ADMIN STYLES ── */
function tp_admin_head() {
    echo '<style>
    .tp-wrap{max-width:1100px;margin:24px auto;font-family:"DM Sans",sans-serif;}
    .tp-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;margin-bottom:20px;}
    .tp-title{font-size:22px;font-weight:800;margin:0 0 20px;color:#111;}
    .tp-btn{display:inline-block;padding:8px 20px;border-radius:8px;background:#e91e8c;color:#fff;font-weight:700;text-decoration:none;border:none;cursor:pointer;font-size:13px;}
    .tp-btn-secondary{background:#6b7280;}
    .tp-table{width:100%;border-collapse:collapse;font-size:13px;}
    .tp-table th{background:#f3f4f6;padding:10px 12px;text-align:left;font-weight:700;border-bottom:2px solid #e5e7eb;}
    .tp-table td{padding:10px 12px;border-bottom:1px solid #f3f4f6;vertical-align:middle;}
    .tp-table tr:hover td{background:#fafafa;}
    .tp-tag{display:inline-block;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#e91e8c22;color:#e91e8c;}
    .tp-form label{display:block;font-size:12px;font-weight:700;color:#374151;margin-bottom:4px;margin-top:14px;}
    .tp-form input,.tp-form select,.tp-form textarea{width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:inherit;}
    .tp-form textarea{min-height:90px;resize:vertical;}
    .tp-grid2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
    .tp-grid3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;}
    .tp-stat{background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:16px;text-align:center;}
    .tp-stat-num{font-size:32px;font-weight:800;color:#e91e8c;}
    .tp-stat-lbl{font-size:12px;color:#6b7280;}
    </style>';
}

/* ─────────────────────────────────────────
   ADMIN PAGES
───────────────────────────────────────── */
function tp_dashboard_page() {
    global $wpdb;
    tp_admin_head();
    $plans   = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}tp_workout_plans");
    $logs    = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}tp_workout_logs");
    $users   = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}tp_user_profiles");
    $cal_sum = $wpdb->get_var("SELECT SUM(calories_burn) FROM {$wpdb->prefix}tp_workout_logs");
    echo '<div class="tp-wrap">';
    echo '<h1 class="tp-title">TrainoPro Dashboard</h1>';
    echo '<div class="tp-grid3" style="margin-bottom:24px">';
    foreach([
        ['Workout Plans', $plans ?? 0, '#e91e8c'],
        ['Workout Logs',  $logs  ?? 0, '#00d4ff'],
        ['User Profiles', $users ?? 0, '#00e676'],
        ['Total Cal Burned', number_format($cal_sum??0), '#fecb00'],
    ] as $s) {
        echo "<div class='tp-stat'><div class='tp-stat-num' style='color:{$s[2]}'>{$s[1]}</div><div class='tp-stat-lbl'>{$s[0]}</div></div>";
    }
    echo '</div>';
    echo '<div style="display:flex;gap:12px;flex-wrap:wrap">';
    echo '<a href="?page=tp-add-plan" class="tp-btn">+ Add Workout Plan</a>';
    echo '<a href="?page=tp-logs" class="tp-btn tp-btn-secondary">View Logs</a>';
    echo '<a href="?page=tp-profiles" class="tp-btn tp-btn-secondary">User Profiles</a>';
    echo '</div></div>';
}

function tp_plans_page() {
    global $wpdb;
    if(isset($_GET['delete']) && check_admin_referer('tp_delete_plan')){
        $wpdb->delete("{$wpdb->prefix}tp_workout_plans", ['id'=>intval($_GET['delete'])]);
        echo '<div class="updated"><p>Plan deleted.</p></div>';
    }
    global $wpdb;
    tp_admin_head();
    $plans = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tp_workout_plans ORDER BY created_at DESC");
    echo '<div class="tp-wrap"><h1 class="tp-title">Workout Plans <a href="?page=tp-add-plan" class="tp-btn" style="font-size:12px;margin-left:12px">+ Add New</a></h1>';
    echo '<div class="tp-card"><table class="tp-table"><thead><tr><th>Plan</th><th>Muscle Group</th><th>Assigned User</th><th>Duration</th><th>Est. Calories</th><th>Difficulty</th><th>Actions</th></tr></thead><tbody>';
    foreach((array)$plans as $p) {
        $user = $p->assigned_user ? get_user_by('id', $p->assigned_user) : null;
        $del_url = wp_nonce_url('?page=tp-plans&delete='.$p->id, 'tp_delete_plan');
        echo "<tr><td><strong>{$p->plan_name}</strong></td><td><span class='tp-tag'>{$p->muscle_group}</span></td><td>".($user ? esc_html($user->display_name):'All Users')."</td><td>{$p->duration_min} min</td><td>{$p->calories_est} kcal</td><td>{$p->difficulty}</td><td style='display:flex;gap:6px'><a href='?page=tp-add-plan&edit={$p->id}' class='tp-btn' style='padding:4px 12px;font-size:11px'>Edit</a><a href='".$del_url."' class='tp-btn' style='padding:4px 12px;font-size:11px;background:#e91e8c' onclick='return confirm(\"Delete this plan?\")'>Delete</a></td></tr>";
    }
    if(empty($plans)) echo '<tr><td colspan="7" style="text-align:center;color:#9ca3af;padding:24px">No plans yet. <a href="?page=tp-add-plan">Add one</a>.</td></tr>';
    echo '</tbody></table></div></div>';
}

function tp_logs_page() {
    global $wpdb;
    tp_admin_head();
    $logs = $wpdb->get_results("SELECT l.*,u.display_name FROM {$wpdb->prefix}tp_workout_logs l LEFT JOIN {$wpdb->users} u ON l.user_id=u.ID ORDER BY l.log_date DESC LIMIT 100");
    echo '<div class="tp-wrap"><h1 class="tp-title">Workout Logs</h1><div class="tp-card">';
    echo '<table class="tp-table"><thead><tr><th>Date</th><th>User</th><th>Exercise</th><th>Sets</th><th>Reps</th><th>Start KG</th><th>End KG</th><th>Cal Burned</th><th>Duration</th><th>Photo</th></tr></thead><tbody>';
    foreach((array)$logs as $l) {
        $photo = $l->photo_url ? "<img src='".esc_url($l->photo_url)."' style='width:40px;height:40px;object-fit:cover;border-radius:6px'>" : '-';
        echo "<tr><td>{$l->log_date}</td><td>".esc_html($l->display_name ?? 'Guest')."</td><td><strong>".esc_html($l->exercise)."</strong><br><small style='color:#9ca3af'>".esc_html($l->muscle_group)."</small></td><td>{$l->sets_done}</td><td>{$l->reps_done}</td><td>{$l->weight_start}</td><td>{$l->weight_end}</td><td>{$l->calories_burn}</td><td>{$l->duration_min}m</td><td>{$photo}</td></tr>";
    }
    if(empty($logs)) echo '<tr><td colspan="10" style="text-align:center;color:#9ca3af;padding:24px">No workout logs yet.</td></tr>';
    echo '</tbody></table></div></div>';
}

function tp_add_plan_page() {
    global $wpdb;
    tp_admin_head();
    $edit_id = intval($_GET['edit'] ?? 0);
    $plan    = $edit_id ? $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tp_workout_plans WHERE id=%d", $edit_id)) : null;

    if(isset($_POST['tp_save_plan'])) {
        check_admin_referer('tp_plan_nonce');
        $ex_names = $_POST['ex_name'] ?? [];
        $ex_sets = $_POST['ex_sets'] ?? [];
        $ex_reps = $_POST['ex_reps'] ?? [];
        $ex_weights = $_POST['ex_weight'] ?? [];
        $ex_lines = [];
        foreach($ex_names as $i => $name){
            $name = sanitize_text_field($name);
            if(!empty($name)) $ex_lines[] = $name.' | '.intval($ex_sets[$i]??3).' | '.sanitize_text_field($ex_reps[$i]??'10').' | '.sanitize_text_field($ex_weights[$i]??'BW');
        }
        if(!empty($ex_lines)){
            $exercises = implode("\n", $ex_lines);
        } elseif($edit_id) {
            $exercises = $wpdb->get_var($wpdb->prepare("SELECT exercises FROM {$wpdb->prefix}tp_workout_plans WHERE id=%d", $edit_id));
        } else {
            $exercises = sanitize_textarea_field($_POST['exercises'] ?? '');
        }
        $data = [
            'plan_name'    => sanitize_text_field($_POST['plan_name']    ?? ''),
            'muscle_group' => $_POST['muscle_group']==='custom' ? sanitize_text_field($_POST['muscle_group_custom']??'') : sanitize_text_field($_POST['muscle_group']??''),
            'exercises'    => $exercises,
            'assigned_user'=> intval($_POST['assigned_user'] ?? 0),
            'duration_min' => intval($_POST['duration_min']  ?? 45),
            'calories_est' => intval($_POST['calories_est']  ?? 300),
            'difficulty'   => sanitize_text_field($_POST['difficulty']   ?? 'Medium'),
            'created_by'   => get_current_user_id(),
        ];
        if($edit_id) $wpdb->update("{$wpdb->prefix}tp_workout_plans", $data, ['id'=>$edit_id]);
        else $wpdb->insert("{$wpdb->prefix}tp_workout_plans", $data);
        echo '<div class="notice notice-success"><p>Workout plan saved! <a href="?page=tp-plans">View all plans</a></p></div>';
        $plan = null;
    }

    $users = get_users(['number'=>200]);
    $title = $edit_id ? 'Edit Workout Plan' : 'Add Workout Plan';
    echo "<div class='tp-wrap'><h1 class='tp-title'>{$title}</h1><div class='tp-card'>";
    echo '<form method="post" class="tp-form">';
    wp_nonce_field('tp_plan_nonce');
    echo '<div class="tp-grid2">';
    echo '<div><label>Plan Name</label><input name="plan_name" required value="'.esc_attr($plan->plan_name??'').'"></div>';
    echo '<div><label>Muscle Group</label><select name="muscle_group"><option value="">Select...</option>';
    foreach(['Chest','Back','Shoulders','Biceps','Triceps','Legs','Glutes','Core','Full Body','Cardio'] as $mg)
        echo "<option ".selected($plan->muscle_group??'',$mg,false).">$mg</option>";
    echo '<option value="custom">Other (type below)...</option>';
    echo '</select>';
    echo '<input type="text" name="muscle_group_custom" id="mg-custom" placeholder="Type custom muscle group..." style="margin-top:8px;display:none" value="'.esc_attr(!in_array($plan->muscle_group??'',["Chest","Back","Shoulders","Biceps","Triceps","Legs","Glutes","Core","Full Body","Cardio","","Select..."]) ? $plan->muscle_group : "").'">';
    echo '<script>
    document.querySelector("[name=muscle_group]").addEventListener("change",function(){
        var ci = document.getElementById("mg-custom");
        if(this.value==="custom"){ci.style.display="block";ci.required=true;}
        else{ci.style.display="none";ci.required=false;}
    });
    </script>';
    echo '</div>';
    echo '<div><label>Duration (mins)</label><input type="number" name="duration_min" value="'.esc_attr($plan->duration_min??45).'"></div>';
    echo '<div><label>Estimated Calories Burned</label><input type="number" name="calories_est" value="'.esc_attr($plan->calories_est??300).'"></div>';
    echo '<div><label>Difficulty</label><select name="difficulty">';
    foreach(['Beginner','Medium','Advanced','Elite'] as $d)
        echo "<option ".selected($plan->difficulty??'Medium',$d,false).">$d</option>";
    echo '</select></div>';
    echo '<div><label>Assign to User (optional)</label><select name="assigned_user"><option value="0">All Users</option>';
    foreach($users as $u) echo "<option value='{$u->ID}' ".selected($plan->assigned_user??0,$u->ID,false).">".esc_html($u->display_name)."</option>";
    echo '</select></div>';
    echo '</div>';
    // Exercise builder UI
    echo '<p style="font-size:13px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;margin:20px 0 12px;padding-bottom:8px;border-bottom:1px solid #e5e7eb">Exercise Builder</p>';
    echo '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;margin-bottom:16px">';
    echo '<div style="display:grid;grid-template-columns:2fr 80px 80px 100px 40px;gap:8px;margin-bottom:8px">';
    echo '<span style="font-size:11px;font-weight:600;color:#6b7280">Exercise Name</span>';
    echo '<span style="font-size:11px;font-weight:600;color:#6b7280">Sets</span>';
    echo '<span style="font-size:11px;font-weight:600;color:#6b7280">Reps</span>';
    echo '<span style="font-size:11px;font-weight:600;color:#6b7280">Target Wt</span>';
    echo '<span></span></div>';
    echo '<div id="ex-rows">';
    $existing_exs = [];
    if(!empty($plan->exercises)){
        foreach(explode("\n", str_replace("\r","", $plan->exercises)) as $line){
            $parts = array_map("trim", explode("|", $line));
            if(!empty($parts[0])) $existing_exs[] = $parts;
        }
    }
    if(empty($existing_exs)) $existing_exs = [["","3","10",""]];
    foreach($existing_exs as $i => $ex){
        echo '<div style="display:grid;grid-template-columns:2fr 80px 80px 100px 40px;gap:8px;margin-bottom:8px;align-items:center">';
        echo '<input type="text" name="ex_name[]" value="'.esc_attr($ex[0]??'').'" placeholder="Exercise name" style="padding:8px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px" required>';
        echo '<input type="number" name="ex_sets[]" value="'.esc_attr($ex[1]??'3').'" min="1" max="20" style="padding:8px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px">';
        echo '<input type="text" name="ex_reps[]" value="'.esc_attr($ex[2]??'10').'" placeholder="10-12" style="padding:8px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px">';
        echo '<input type="text" name="ex_weight[]" value="'.esc_attr($ex[3]??'').'" placeholder="80kg" style="padding:8px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px">';
        echo '<button type="button" onclick="this.parentNode.remove()" style="background:#fee2e2;border:none;border-radius:6px;padding:8px;cursor:pointer;color:#dc2626;font-size:16px">&#x2715;</button>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button type="button" onclick="addExRow()" style="background:#f0fdf4;border:1px dashed #86efac;border-radius:8px;padding:10px;width:100%;cursor:pointer;color:#16a34a;font-size:13px;font-weight:600;margin-top:8px">+ Add Exercise</button>';
    echo '</div>';
    echo '<script>function addExRow(){var r=document.createElement("div");r.style="display:grid;grid-template-columns:2fr 80px 80px 100px 40px;gap:8px;margin-bottom:8px;align-items:center";r.innerHTML="<input type=\"text\" name=\"ex_name[]\" placeholder=\"Exercise name\" style=\"padding:8px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px\" required><input type=\"number\" name=\"ex_sets[]\" value=\"3\" min=\"1\" max=\"20\" style=\"padding:8px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px\"><input type=\"text\" name=\"ex_reps[]\" value=\"10\" placeholder=\"10-12\" style=\"padding:8px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px\"><input type=\"text\" name=\"ex_weight[]\" placeholder=\"80kg\" style=\"padding:8px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px\"><button type=\"button\" onclick=\"this.closest(\'div\').remove()\" style=\"background:#fee2e2;border:none;border-radius:6px;padding:8px;cursor:pointer;color:#dc2626;font-size:16px\">&#x2715;</button>";document.getElementById("ex-rows").appendChild(r);}</script>';
    echo '<div style="margin-top:20px"><button type="submit" name="tp_save_plan" class="tp-btn">Save Workout Plan</button> <a href="?page=tp-plans" class="tp-btn tp-btn-secondary" style="margin-left:8px">Cancel</a></div>';
    echo '</form></div></div>';
}

function tp_profiles_page() {
    global $wpdb;
    tp_admin_head();
    $profiles = $wpdb->get_results("SELECT p.*,u.display_name FROM {$wpdb->prefix}tp_user_profiles p LEFT JOIN {$wpdb->users} u ON p.user_id=u.ID ORDER BY p.created_at DESC");
    echo '<div class="tp-wrap"><h1 class="tp-title">User Profiles</h1><div class="tp-card">';
    echo '<table class="tp-table"><thead><tr><th>Photo</th><th>Name</th><th>Age/Gender</th><th>Blood</th><th>Goal</th><th>Coach</th><th>Weight</th><th>Ideal</th><th>Health Notes</th></tr></thead><tbody>';
    foreach((array)$profiles as $p) {
        $photo = $p->profile_photo ? "<img src='".esc_url($p->profile_photo)."' style='width:36px;height:36px;object-fit:cover;border-radius:50%'>" : '<div style="width:36px;height:36px;background:#e5e7eb;border-radius:50%;display:flex;align-items:center;justify-content:center">👤</div>';
        echo "<tr><td>{$photo}</td><td><strong>".esc_html($p->full_name)."</strong><br><small style='color:#9ca3af'>".esc_html($p->email)." · ".esc_html($p->mobile)."</small></td><td>{$p->age} / ".esc_html($p->gender)."</td><td><span class='tp-tag'>".esc_html($p->blood_group)."</span></td><td>".esc_html($p->goal)."</td><td>".esc_html($p->coach)."</td><td>{$p->current_weight} kg</td><td>{$p->ideal_weight} kg</td><td style='max-width:180px;font-size:11px'>".esc_html(wp_trim_words($p->health_notes,10))."</td></tr>";
    }
    if(empty($profiles)) echo '<tr><td colspan="9" style="text-align:center;color:#9ca3af;padding:24px">No profiles yet.</td></tr>';
    echo '</tbody></table></div></div>';
}

/* ─────────────────────────────────────────
   REST API ENDPOINTS
───────────────────────────────────────── */
add_action( 'rest_api_init', 'tp_register_routes' );
function tp_register_routes() {
    $ns = 'trainopro/v1';

    // Get today's workout plan for current user
    register_rest_route($ns, '/today-plan', [
        'methods'  => 'GET',
        'callback' => 'tp_api_today_plan',
        'permission_callback' => '__return_true',
    ]);

    // Get workout history
    register_rest_route($ns, '/history', [
        'methods'  => 'GET',
        'callback' => 'tp_api_history',
        'permission_callback' => '__return_true',
    ]);

    // Log a workout session
    register_rest_route($ns, '/log', [
        'methods'  => 'POST',
        'callback' => 'tp_api_log_workout',
        'permission_callback' => '__return_true',
    ]);

    // Get/save user profile
    register_rest_route($ns, '/profile', [
        'methods'  => ['GET','POST'],
        'callback' => 'tp_api_profile',
        'permission_callback' => '__return_true',
    ]);

    // Get all plans
    register_rest_route($ns, '/plans', [
        'methods'  => 'GET',
        'callback' => 'tp_api_plans',
        'permission_callback' => '__return_true',
    ]);

    // Log a daily metric (water/meal)
    register_rest_route($ns, '/log-metric', [
        'methods'  => 'POST',
        'callback' => 'tp_api_log_metric',
        'permission_callback' => '__return_true',
    ]);

    // Get daily summary
    register_rest_route($ns, '/daily-summary', [
        'methods'  => 'GET',
        'callback' => 'tp_api_daily_summary',
        'permission_callback' => '__return_true',
    ]);
}

function tp_api_today_plan($req) {
    global $wpdb;
    $user_id = get_current_user_id();
    // Get plan assigned to this user or public plans
    $plan = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}tp_workout_plans WHERE assigned_user=%d OR assigned_user=0 ORDER BY id DESC LIMIT 1",
        $user_id
    ));
    if(!$plan) return rest_ensure_response(['exercises'=>[],'plan_name'=>'Rest Day']);
    $exercises = [];
    foreach(explode("\n", $plan->exercises ?? '') as $line) {
        $parts = array_map('trim', explode('|', $line));
        if(count($parts) >= 4) $exercises[] = ['name'=>$parts[0],'sets'=>$parts[1],'reps'=>$parts[2],'target_weight'=>$parts[3]];
        elseif(!empty($parts[0])) $exercises[] = ['name'=>$parts[0],'sets'=>'3','reps'=>'10-12','target_weight'=>'Bodyweight'];
    }
    return rest_ensure_response(array_merge((array)$plan, ['exercise_list'=>$exercises]));
}

function tp_api_history($req) {
    global $wpdb;
    $user_id = get_current_user_id();
    $limit   = intval($req->get_param('limit') ?? 20);
    $logs = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}tp_workout_logs WHERE user_id=%d ORDER BY log_date DESC LIMIT %d",
        $user_id ?: 1, $limit
    ));
    return rest_ensure_response($logs ?: []);
}

function tp_api_log_workout($req) {
    global $wpdb;
    $data = $req->get_json_params();
    $row  = [
        'user_id'      => get_current_user_id() ?: 1,
        'plan_id'      => intval($data['plan_id']       ?? 0),
        'log_date'     => sanitize_text_field($data['log_date']     ?? date('Y-m-d')),
        'muscle_group' => sanitize_text_field($data['muscle_group'] ?? ''),
        'exercise'     => sanitize_text_field($data['exercise']     ?? ''),
        'sets_done'    => intval($data['sets_done']    ?? 0),
        'reps_done'    => intval($data['reps_done']    ?? 0),
        'weight_start' => floatval($data['weight_start'] ?? 0),
        'weight_end'   => floatval($data['weight_end']   ?? 0),
        'calories_burn'=> intval($data['calories_burn'] ?? 0),
        'duration_min' => intval($data['duration_min']  ?? 0),
        'notes'        => sanitize_textarea_field($data['notes']    ?? ''),
        'photo_url'    => esc_url_raw($data['photo_url'] ?? ''),
    ];
    $result = $wpdb->insert("{$wpdb->prefix}tp_workout_logs", $row);
    if(!$result) return new WP_Error('db_error', $wpdb->last_error, ['status'=>500]);
    return rest_ensure_response(['success'=>true, 'id'=>$wpdb->insert_id, 'data'=>$row]);
}

function tp_api_profile($req) {
    global $wpdb;
    $user_id = get_current_user_id() ?: 1;
    if($req->get_method() === 'GET') {
        $profile = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tp_user_profiles WHERE user_id=%d", $user_id));
        return rest_ensure_response($profile ?: new stdClass());
    }
    $data = $req->get_json_params() ?: [];
    $row  = [
        'user_id'        => $user_id,
        'full_name'      => sanitize_text_field($data['full_name']      ?? ''),
        'email'          => sanitize_email($data['email']               ?? ''),
        'mobile'         => sanitize_text_field($data['mobile']         ?? ''),
        'age'            => intval($data['age']                         ?? 0),
        'gender'         => sanitize_text_field($data['gender']         ?? ''),
        'blood_group'    => sanitize_text_field($data['blood_group']    ?? ''),
        'goal'           => sanitize_text_field($data['goal']           ?? ''),
        'coach'          => sanitize_text_field($data['coach']          ?? ''),
        'profile_photo'  => esc_url_raw($data['profile_photo']         ?? ''),
        'current_weight' => floatval($data['current_weight']           ?? 0),
        'ideal_weight'   => floatval($data['ideal_weight']             ?? 0),
        'health_notes'   => sanitize_textarea_field($data['health_notes'] ?? ''),
    ];
    $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$wpdb->prefix}tp_user_profiles WHERE user_id=%d", $user_id));
    if($exists) $wpdb->update("{$wpdb->prefix}tp_user_profiles", $row, ['user_id'=>$user_id]);
    else $wpdb->insert("{$wpdb->prefix}tp_user_profiles", $row);
    return rest_ensure_response(['success'=>true, 'profile'=>$row]);
}

function tp_api_plans($req) {
    global $wpdb;
    $plans = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tp_workout_plans ORDER BY created_at DESC");
    foreach((array)$plans as &$p) {
        $exercises = [];
        foreach(explode("\n", $p->exercises ?? '') as $line) {
            $parts = array_map('trim', explode('|', $line));
            if(!empty($parts[0])) $exercises[] = ['name'=>$parts[0],'sets'=>$parts[1]??'3','reps'=>$parts[2]??'10','target_weight'=>$parts[3]??''];
        }
        $p->exercise_list = $exercises;
    }
    return rest_ensure_response($plans ?: []);
}

function tp_api_log_metric($req) {
    global $wpdb;
    $data = $req->get_json_params();
    $row  = [
        'user_id'      => get_current_user_id() ?: 1,
        'metric_type'  => sanitize_text_field($data['metric_type']  ?? 'water'),
        'metric_value' => floatval($data['metric_value'] ?? 0),
        'protein'      => floatval($data['protein']      ?? 0),
        'carbs'        => floatval($data['carbs']        ?? 0),
        'fat'          => floatval($data['fat']          ?? 0),
        'log_date'     => sanitize_text_field($data['log_date']     ?? date('Y-m-d')),
    ];
    $result = $wpdb->insert("{$wpdb->prefix}tp_daily_metrics", $row);
    if(!$result) return new WP_Error('db_error', $wpdb->last_error, ['status'=>500]);
    return rest_ensure_response(['success'=>true, 'id'=>$wpdb->insert_id]);
}

function tp_api_daily_summary($req) {
    global $wpdb;
    $user_id = get_current_user_id() ?: 1;
    $date    = sanitize_text_field($req->get_param('date') ?? date('Y-m-d'));
    
    $summary = $wpdb->get_row($wpdb->prepare(
        "SELECT 
            SUM(CASE WHEN metric_type='water' THEN metric_value ELSE 0 END) as water_ml,
            SUM(CASE WHEN metric_type='meal' THEN metric_value ELSE 0 END) as calories,
            SUM(protein) as protein,
            SUM(carbs) as carbs,
            SUM(fat) as fat
        FROM {$wpdb->prefix}tp_daily_metrics 
        WHERE user_id=%d AND log_date=%s",
        $user_id, $date
    ));

    return rest_ensure_response($summary ?: [
        'water_ml'=>0, 'calories'=>0, 'protein'=>0, 'carbs'=>0, 'fat'=>0
    ]);
}

/* ─────────────────────────────────────────
   SHORTCODES
───────────────────────────────────────── */
add_shortcode('tp_register',   'tp_shortcode_register');
add_shortcode('tp_history',    'tp_shortcode_history');
add_shortcode('tp_workout',    'tp_shortcode_workout');

function tp_shortcode_register($atts) {
    ob_start();
    // Handled by page-register.php template
    echo '<div id="tp-register-mount" data-rest="'.esc_url(rest_url('trainopro/v1/')).'"></div>';
    return ob_get_clean();
}

function tp_shortcode_history($atts) {
    ob_start();
    echo '<div id="tp-history-mount" data-rest="'.esc_url(rest_url('trainopro/v1/')).'"></div>';
    return ob_get_clean();
}

function tp_shortcode_workout($atts) {
    ob_start();
    echo '<div id="tp-workout-mount" data-rest="'.esc_url(rest_url('trainopro/v1/')).'"></div>';
    return ob_get_clean();
}

/* ─────────────────────────────────────────
   MEDIA UPLOAD (photo for logs/profiles)
───────────────────────────────────────── */
add_action('rest_api_init', function() {
    register_rest_route('trainopro/v1', '/upload-photo', [
        'methods'  => 'POST',
        'callback' => 'tp_api_upload_photo',
        'permission_callback' => '__return_true',
    ]);
});
function tp_api_upload_photo($req) {
    if(!function_exists('wp_handle_upload')) require_once ABSPATH.'wp-admin/includes/file.php';
    if(!function_exists('wp_generate_attachment_metadata')) require_once ABSPATH.'wp-admin/includes/image.php';
    if(!function_exists('wp_insert_attachment')) require_once ABSPATH.'wp-admin/includes/media.php';
    $file = $_FILES['photo'] ?? null;
    if(!$file) return new WP_Error('no_file','No photo uploaded',['status'=>400]);
    $uploaded = wp_handle_upload($file, ['test_form'=>false]);
    if(isset($uploaded['error'])) return new WP_Error('upload_error',$uploaded['error'],['status'=>500]);
    return rest_ensure_response(['url'=>$uploaded['url'],'success'=>true]);
}


add_action('admin_footer', function(){
  $screen = get_current_screen();
  if(!$screen || strpos($screen->id,'tp-plans') === false) return;
  echo '<script>
  document.addEventListener("DOMContentLoaded", function(){
    var rows = document.querySelectorAll(".tp-table tbody tr");
    var groups = {};
    rows.forEach(function(row){
      var mg = row.querySelector(".tp-tag");
      var key = mg ? mg.textContent.trim() : "Other";
      if(!groups[key]) groups[key] = [];
      groups[key].push(row.cloneNode(true));
    });
    var tbody = document.querySelector(".tp-table tbody");
    if(!tbody) return;
    tbody.innerHTML = "";
    Object.keys(groups).sort().forEach(function(mg){
      var hdr = document.createElement("tr");
      hdr.innerHTML = "<td colspan=\"7\" style=\"background:#f3f4f6;font-weight:700;font-size:12px;color:#6b7280;text-transform:uppercase;letter-spacing:1px;padding:8px 16px\">"+mg+"</td>";
      tbody.appendChild(hdr);
      groups[mg].forEach(function(r){ tbody.appendChild(r); });
    });
  });
  </script>';
});
