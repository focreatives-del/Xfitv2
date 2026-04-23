<?php
/**
 * Template Name: Workout View
 * Dedicated page for viewing and logging workouts.
 */
get_header();
?>

<!-- Extra styles for standalone page -->
<style>
#xd-standalone-work{background:#09090c;min-height:100vh;padding:40px 20px;}
.work-container{max-width:850px;margin:0 auto;background:#0d0d0f;border:1px solid rgba(255,255,255,.1);border-radius:28px;padding:32px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);}
/* Re-use workout classes from front-page.php */
</style>

<div id="xd-standalone-work">
<div class="work-container">
    <div class="work-head">
      <div class="work-title-wrap">
        <span class="work-subtitle">Your Plan</span>
        <h3 id="work-plan-name">Today Workout</h3>
      </div>
      <div class="calendar-mini">
        <div class="cal-day"><span class="d-name">Mon</span><span class="d-num">24</span></div>
        <div class="cal-day"><span class="d-name">Tue</span><span class="d-num">25</span></div>
        <div class="cal-day"><span class="d-name">Wed</span><span class="d-num">26</span></div>
        <div class="cal-day"><span class="d-name">Thu</span><span class="d-num">27</span></div>
        <div class="cal-day today active"><span class="d-name">Fri</span><span class="d-num">28</span></div>
        <div class="cal-day"><span class="d-name">Sat</span><span class="d-num">29</span></div>
        <div class="cal-day"><span class="d-name">Sun</span><span class="d-num">30</span></div>
      </div>
    </div>

    <div class="work-stats-row">
      <div class="work-stat-pill pill-accent" id="work-mg">CHEST</div>
      <div class="work-stat-pill"><span>Total calories burned</span> <b id="work-cal">320</b></div>
      <div class="work-stat-pill"><span>Total Time</span> <b id="work-time">45:00</b></div>
    </div>

    <div class="ex-grid" id="ex-list-mount">
      <div style="padding:40px;text-align:center;color:rgba(255,255,255,0.2)">Loading workout plan...</div>
    </div>

    <div style="margin-top:24px; text-align:center;">
        <a href="<?php echo home_url('/'); ?>" class="wbtn wbtn-g" style="display:inline-block; width:auto; padding:10px 24px;">Return to Dashboard</a>
    </div>
</div>
</div>

<script>
// Specialized logic for the standalone page
const GW = {
    s: {
        restUrl: '/wp-json/trainopro/v1/'
    },
    async init() {
        try {
            const resp = await fetch(this.s.restUrl + 'today-plan');
            const data = await resp.json();
            this.renderWorkout(data);
        } catch (e) {
            document.getElementById('ex-list-mount').innerHTML = '<div style="padding:40px;text-align:center;color:#e91e8c">Error loading plan.</div>';
        }
    },
    renderWorkout(data) {
        document.getElementById('work-plan-name').textContent = data.plan_name || 'Today Workout';
        document.getElementById('work-mg').textContent = (data.muscle_group || 'CHEST').toUpperCase();
        document.getElementById('work-cal').textContent = data.calories_est || '320';
        document.getElementById('work-time').textContent = (data.duration_min || '45') + ':00';

        const mount = document.getElementById('ex-list-mount');
        if (data.exercise_list && data.exercise_list.length > 0) {
            mount.innerHTML = data.exercise_list.map(ex => `
              <div class="ex-card">
                <div class="ex-img-wrap">
                  <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&q=80&w=200" class="ex-img" alt="${ex.name}">
                  <div class="ex-img-overlay"></div>
                </div>
                <div class="ex-info">
                  <span class="ex-badge badge-ch">${data.muscle_group || 'Chest'}</span>
                  <span class="ex-name">${ex.name}</span>
                  <div style="display:flex; gap:10px; align-items:center; margin-top:8px;">
                     <span style="font-size:11px; color:rgba(255,255,255,0.4)">${ex.sets} sets &bull; ${ex.reps} reps</span>
                     <span style="font-size:11px; color:rgba(255,255,255,0.4)">Tar: ${ex.target_weight}</span>
                  </div>
                </div>
                <div class="ex-action">
                  <div class="ex-plus" onclick="alert('Logged!')">+</div>
                </div>
              </div>
            `).join('');
        } else {
             mount.innerHTML = '<div style="padding:40px;text-align:center;color:rgba(255,255,255,0.4)">No exercises for today.</div>';
        }
    }
};
document.addEventListener('DOMContentLoaded', () => GW.init());
</script>

<?php get_footer(); ?>
