<?php
/**
 * Template Name: Muscle Workout
 */
get_header();
$plan_id = isset($_GET['plan_id']) ? intval($_GET['plan_id']) : 0;
global $wpdb;
$p = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tp_workout_plans WHERE id=%d", $plan_id));
if(!$p && $plan_id===0) $p = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}tp_workout_plans ORDER BY id DESC LIMIT 1");
$exs=[];
if($p){
  foreach(explode("\n",str_replace("\r","",$p->exercises??'')) as $l){
    $pts=array_map('trim',explode('|',$l));
    if(!empty($pts[0]))$exs[]=['n'=>$pts[0],'s'=>$pts[1]??'3','r'=>$pts[2]??'10','w'=>$pts[3]??'BW'];
  }
}
$plan_data = $p ? ['id'=>(int)$p->id,'nm'=>$p->plan_name,'mg'=>$p->muscle_group,'cal'=>(int)$p->calories_est,'dur'=>(int)$p->duration_min,'ex'=>$exs] : null;
$back_url = home_url('/index.php/workout/');
?>
<style>
*{box-sizing:border-box}
#mp{background:#09090c;min-height:100vh;padding:90px 24px 60px}
.mhero{position:relative;width:100%;height:280px;border-radius:24px;overflow:hidden;margin-bottom:28px}
.mhero img{width:100%;height:100%;object-fit:cover}
.mhero-ov{position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,.2),rgba(0,0,0,.85))}
.mhero-body{position:absolute;bottom:0;left:0;right:0;padding:28px}
.mbadge{display:inline-block;padding:5px 16px;border-radius:20px;font-size:11px;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:2px;margin-bottom:10px}
.mtitle{font-size:2rem;font-weight:900;color:#fff;margin-bottom:8px}
.mmeta{display:flex;gap:20px;flex-wrap:wrap}
.mmeta span{font-size:13px;color:rgba(255,255,255,.7)}
.mmeta b{color:#fff}
.wstats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px}
.wsc{background:#111114;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:16px;text-align:center}
.wsv{font-size:22px;font-weight:800;display:block;margin-bottom:4px}
.wsl{font-size:10px;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:1px}
.calrow{background:linear-gradient(135deg,rgba(254,203,0,.1),rgba(233,30,140,.1));border:1px solid rgba(254,203,0,.2);border-radius:16px;padding:16px;display:flex;align-items:center;justify-content:space-between;margin-bottom:28px}
.calval{font-size:32px;font-weight:900;color:#fecb00}
.callbl{font-size:11px;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px}
.exlist{display:flex;flex-direction:column;gap:16px;margin-bottom:28px}
.exc{background:#111114;border:1px solid rgba(255,255,255,.08);border-radius:20px;overflow:hidden;transition:border-color .2s}
.exc.open{border-color:#e91e8c}
.exh{display:flex;gap:16px;padding:16px;align-items:center;cursor:pointer}
.exthumb{width:80px;height:80px;border-radius:12px;object-fit:cover;flex-shrink:0}
.exinfo{flex:1}
.exnum{font-size:10px;color:rgba(255,255,255,.3);text-transform:uppercase;letter-spacing:2px;margin-bottom:4px}
.exname{font-size:16px;font-weight:700;color:#fff;margin-bottom:4px}
.extarget{font-size:12px;color:rgba(255,255,255,.5)}
.exchev{color:rgba(255,255,255,.3);font-size:18px;transition:transform .3s}
.exc.open .exchev{transform:rotate(180deg)}
.exstat{width:28px;height:28px;border-radius:50%;border:2px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:12px;color:transparent;flex-shrink:0}
.exstat.done{background:#00c853;border-color:#00c853;color:#fff}
.st{display:none;padding:0 16px 16px}
.exc.open .st{display:block}
.sth{display:grid;grid-template-columns:50px 1fr 1fr 1fr 40px;gap:8px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.06);margin-bottom:8px}
.sthl{font-size:10px;color:rgba(255,255,255,.3);text-transform:uppercase;letter-spacing:1px;text-align:center}
.sr{display:grid;grid-template-columns:50px 1fr 1fr 1fr 40px;gap:8px;align-items:center;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.04)}
.sr.done{background:rgba(0,200,83,.05);border-radius:8px;padding:8px}
.sl{font-size:12px;font-weight:700;color:rgba(255,255,255,.5);text-align:center}
.sr.done .sl{color:#00c853}
.si{width:100%;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:8px;color:#fff;font-size:13px;text-align:center;outline:none}
.si:focus{border-color:#00d4ff}
.si.hl{border-color:rgba(233,30,140,.4)}
.sc{width:32px;height:32px;border-radius:50%;border:2px solid rgba(255,255,255,.2);background:transparent;color:transparent;cursor:pointer;font-size:14px;transition:all .2s;display:block;margin:0 auto}
.sc.ck{background:#00c853;border-color:#00c853;color:#fff}
.addset{display:flex;align-items:center;justify-content:center;gap:8px;padding:10px;border:1px dashed rgba(255,255,255,.1);border-radius:10px;color:rgba(255,255,255,.3);font-size:12px;cursor:pointer;margin-top:8px}
.addset:hover{border-color:#00d4ff;color:#00d4ff}
.cbtn{display:block;width:100%;padding:18px;background:linear-gradient(135deg,#e91e8c,#9b59b6);color:#fff;border:none;border-radius:16px;font-size:16px;font-weight:700;cursor:pointer;text-align:center;margin-bottom:16px}
.rb{display:block;width:100%;padding:14px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:16px;color:rgba(255,255,255,.6);font-size:14px;text-align:center;text-decoration:none}
.empty{padding:80px;text-align:center;color:rgba(255,255,255,.3)}
@media(max-width:768px){.wstats{grid-template-columns:repeat(2,1fr)}.sth,.sr{grid-template-columns:40px 1fr 1fr 1fr 36px;gap:6px}}
</style>
<div id="mp">
<?php if(!$plan_data): ?>
<div class="empty">No plan found. <a href="<?php echo $back_url; ?>" style="color:#e91e8c">Go back</a></div>
<?php else: ?>
<div class="mhero">
  <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&q=80" alt="">
  <div class="mhero-ov"></div>
  <div class="mhero-body">
    <span class="mbadge" style="background:#e91e8c"><?php echo esc_html($plan_data['mg']); ?></span>
    <div class="mtitle"><?php echo esc_html($plan_data['nm']); ?> Workout</div>
    <div class="mmeta">
      <span><b><?php echo count($plan_data['ex']); ?></b> Exercises</span>
      <span><b><?php echo $plan_data['dur']; ?></b> mins</span>
      <span><b><?php echo $plan_data['cal']; ?></b> kcal</span>
    </div>
  </div>
</div>
<div class="wstats">
  <div class="wsc"><span class="wsv" style="color:#e91e8c" id="ws-cal">0 kcal</span><span class="wsl">Calories</span></div>
  <div class="wsc"><span class="wsv" style="color:#00d4ff" id="ws-sets">0/<?php echo array_sum(array_map(function($e){return intval($e['s']);}, $plan_data['ex'])); ?></span><span class="wsl">Sets Done</span></div>
  <div class="wsc"><span class="wsv" style="color:#fecb00" id="ws-prog">0%</span><span class="wsl">Progress</span></div>
  <div class="wsc"><span class="wsv" style="color:#00c853" id="ws-time">00:00</span><span class="wsl">Time</span></div>
</div>
<div class="calrow">
  <div><div class="callbl">Calories Burned</div><div class="calval" id="cal-disp">0 kcal</div></div>
  <div style="text-align:right"><div class="callbl">Sets Completed</div><div style="font-size:18px;font-weight:700;color:#fff" id="sets-disp">0/<?php echo array_sum(array_map(function($e){return intval($e['s']);}, $plan_data['ex'])); ?></div></div>
</div>
<div class="exlist" id="exlist">
<?php foreach($plan_data['ex'] as $ei => $ex): ?>
<?php $ns = intval($ex['s']); $wn = preg_replace('/[^0-9.]/','',$ex['w']); if(!$wn)$wn='0'; ?>
<div class="exc" id="exc-<?php echo $ei; ?>">
  <div class="exh" onclick="toggleEx(<?php echo $ei; ?>)">
    <img class="exthumb" src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=200&q=80" alt="">
    <div class="exinfo">
      <div class="exnum">Exercise <?php echo $ei+1; ?></div>
      <div class="exname"><?php echo esc_html($ex['n']); ?></div>
      <div class="extarget"><?php echo $ex['s']; ?> sets &bull; <?php echo $ex['r']; ?> reps &bull; <?php echo esc_html($ex['w']); ?></div>
    </div>
    <div class="exstat" id="exstat-<?php echo $ei; ?>">✓</div>
    <div class="exchev">▾</div>
  </div>
  <div class="st" id="st-<?php echo $ei; ?>">
    <div class="sth"><div class="sthl">Set</div><div class="sthl">Reps</div><div class="sthl">Start kg</div><div class="sthl">End kg</div><div class="sthl">✓</div></div>
    <div id="sb-<?php echo $ei; ?>">
      <?php for($s=1;$s<=$ns;$s++): ?>
      <div class="sr" id="sr-<?php echo $ei; ?>-<?php echo $s; ?>">
        <div class="sl"><?php echo $s; ?></div>
        <input class="si" type="number" value="<?php echo explode('-',$ex['r'])[0]; ?>" min="1">
        <input class="si hl" type="number" value="<?php echo $wn; ?>" step="0.5" min="0">
        <input class="si" type="number" value="<?php echo $wn; ?>" step="0.5" min="0">
        <button class="sc" onclick="toggleSet(this,<?php echo $ei; ?>,<?php echo $s; ?>,<?php echo round($plan_data['cal']/max(1,array_sum(array_map(function($e){return intval($e['s']);}, $plan_data['ex'])))); ?>)">✓</button>
      </div>
      <?php endfor; ?>
    </div>
    <div class="addset" onclick="addSet(<?php echo $ei; ?>,<?php echo round($plan_data['cal']/max(1,array_sum(array_map(function($e){return intval($e['s']);}, $plan_data['ex'])))); ?>)">+ Add Set</div>
  </div>
</div>
<?php endforeach; ?>
</div>
<button class="cbtn" id="cbtn" onclick="completeWorkout()">Complete Workout 🏆</button>
<a href="<?php echo $back_url; ?>" class="rb">← Back to All Plans</a>
<?php endif; ?>
</div>
<script>
var totalCal=0,setsDone=0,totalSets=<?php echo array_sum(array_map(function($e){return intval($e['s']);}, $plan_data['ex']??[])); ?>,timerStart=Date.now();
var REST="<?php echo esc_js(home_url('/wordpress/')); ?>";
var NONCE="<?php echo wp_create_nonce('wp_rest'); ?>";
var PLAN_ID=<?php echo (int)($plan_data['id']??0); ?>;
var PLAN_MG="<?php echo esc_js($plan_data['mg']??''); ?>";
var PLAN_NM="<?php echo esc_js($plan_data['nm']??''); ?>";
function toggleEx(i){var c=document.getElementById("exc-"+i);c.classList.toggle("open");}
function toggleSet(btn,ei,si,cps){
  btn.classList.toggle("ck");
  var row=document.getElementById("sr-"+ei+"-"+si);
  row.classList.toggle("done");
  var done=btn.classList.contains("ck");
  if(done){setsDone++;totalCal+=cps;}else{setsDone--;totalCal-=cps;}
  if(setsDone<0)setsDone=0;if(totalCal<0)totalCal=0;
  updateStats();
  var allDone=true;
  document.querySelectorAll("#sb-"+ei+" .sc").forEach(function(c){if(!c.classList.contains("ck"))allDone=false;});
  var es=document.getElementById("exstat-"+ei);
  if(allDone)es.classList.add("done");else es.classList.remove("done");
}
function addSet(ei,cps){
  var sb=document.getElementById("sb-"+ei);
  var n=sb.querySelectorAll(".sr").length+1;
  var d=document.createElement("div");d.className="sr";d.id="sr-"+ei+"-"+n;
  d.innerHTML='<div class="sl">'+n+'</div><input class="si" type="number" value="10" min="1"><input class="si hl" type="number" value="0" step="0.5" min="0"><input class="si" type="number" value="0" step="0.5" min="0"><button class="sc" onclick="toggleSet(this,'+ei+','+n+','+cps+')">✓</button>';
  sb.appendChild(d);totalSets++;updateStats();
}
function updateStats(){
  var pct=totalSets>0?Math.round(setsDone/totalSets*100):0;
  document.getElementById("ws-cal").textContent=totalCal+" kcal";
  document.getElementById("ws-sets").textContent=setsDone+"/"+totalSets;
  document.getElementById("ws-prog").textContent=pct+"%";
  document.getElementById("cal-disp").textContent=totalCal+" kcal";
  document.getElementById("sets-disp").textContent=setsDone+"/"+totalSets;
}
function startTimer(){setInterval(function(){var e=Math.floor((Date.now()-timerStart)/1000),m=Math.floor(e/60),s=e%60,el=document.getElementById("ws-time");if(el)el.textContent=(m<10?"0":"")+m+":"+(s<10?"0":"")+s;},1000);}
function completeWorkout(){
  var btn=document.getElementById("cbtn");btn.textContent="Saving...";btn.disabled=true;
  var payload={plan_id:PLAN_ID,muscle_group:PLAN_MG,exercise:PLAN_NM,sets_done:setsDone,reps_done:10,weight_start:0,weight_end:0,calories_burn:totalCal,notes:"",log_date:new Date().toISOString().split("T")[0],duration_min:Math.round((Date.now()-timerStart)/60000)};
  fetch(REST+"?rest_route=/trainopro/v1/log",{method:"POST",headers:{"Content-Type":"application/json","X-WP-Nonce":NONCE},body:JSON.stringify(payload)})
  .then(function(r){return r.json();})
  .then(function(res){if(res.success){btn.textContent="✓ Done! "+totalCal+" kcal";btn.style.background="#00c853";}else{btn.textContent="Complete Workout";btn.disabled=false;}})
  .catch(function(){btn.textContent="Complete Workout";btn.disabled=false;});
}
document.addEventListener("DOMContentLoaded",startTimer);
</script>
<?php get_footer(); ?>
