<?php
/**
 * Template Name: Workout View
 * Connected to TrainoPro plugin REST API
 */
get_header();
?>
<style>
#xd-workout-page{background:#09090c;min-height:100vh;padding:100px 24px 60px;}
*{box-sizing:border-box;}
.cal-strip{display:flex;justify-content:flex-end;gap:8px;margin-bottom:28px;}
.cal-day{display:flex;flex-direction:column;align-items:center;justify-content:center;width:52px;height:64px;border-radius:14px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);cursor:pointer;transition:all .2s;}
.cal-day.active{background:rgba(233,30,140,0.18);border-color:#e91e8c;}
.cal-day .d-name{font-size:10px;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;}
.cal-day .d-num{font-size:18px;font-weight:700;color:#fff;}
.cal-day.active .d-num{color:#e91e8c;}
.cal-day .d-dots{display:flex;gap:3px;margin-top:4px;}
.cal-day .d-dots span{width:4px;height:4px;border-radius:50%;background:rgba(255,255,255,0.15);}
.cal-day.active .d-dots span:nth-child(1){background:#e91e8c;}
.cal-day.active .d-dots span:nth-child(2){background:#00d4ff;}
.cal-day.active .d-dots span:nth-child(3){background:#fecb00;}
.muscle-section{background:#111114;border:1px solid rgba(255,255,255,0.08);border-radius:20px;padding:24px;margin-bottom:24px;}
.muscle-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;}
.muscle-badge{font-size:12px;font-weight:700;letter-spacing:2px;padding:6px 18px;border-radius:20px;text-transform:uppercase;color:#fff;}
.stats-pills{display:flex;border:1px solid rgba(255,255,255,0.15);border-radius:8px;overflow:hidden;}
.stat-pill{padding:8px 16px;font-size:12px;color:rgba(255,255,255,0.7);background:rgba(255,255,255,0.04);white-space:nowrap;}
.stat-pill b{color:#fff;margin-left:4px;}
.stat-pill:not(:last-child){border-right:1px solid rgba(255,255,255,0.15);}
.carousel-wrap{position:relative;display:flex;align-items:center;gap:12px;}
.carousel-btn{flex-shrink:0;width:44px;height:44px;border-radius:50%;background:rgba(80,60,140,0.7);border:1px solid rgba(255,255,255,0.1);color:#fff;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;}
.carousel-track-wrap{flex:1;overflow:hidden;border-radius:16px;}
.carousel-track{display:flex;gap:16px;transition:transform .4s cubic-bezier(.4,0,.2,1);}
.ex-card-new{flex:0 0 calc(33.333% - 11px);min-width:0;border-radius:20px;overflow:hidden;position:relative;cursor:pointer;transition:transform .2s;min-height:280px;}
.ex-card-new:hover{transform:translateY(-4px);}
.ex-card-img{width:100%;height:280px;object-fit:cover;display:block;}
.ex-card-overlay{position:absolute;inset:0;}
.ex-card-body{position:absolute;bottom:0;left:0;right:0;padding:20px 16px;}
.ex-card-title{font-size:16px;font-weight:800;color:#fff;margin-bottom:6px;line-height:1.3;}
.ex-card-meta{font-size:11px;color:rgba(255,255,255,0.7);margin-bottom:12px;}
.ex-card-btn{width:28px;height:28px;border-radius:50%;border:2px solid rgba(255,255,255,0.6);background:transparent;color:#fff;font-size:16px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;line-height:1;}
.ex-card-btn.logged{background:#00d4ff;border-color:#00d4ff;}
.accent-pink .ex-card-overlay{background:linear-gradient(to bottom,rgba(233,30,140,0.25) 0%,rgba(180,10,100,0.88) 100%);}
.accent-blue .ex-card-overlay{background:linear-gradient(to bottom,rgba(0,150,255,0.25) 0%,rgba(0,100,200,0.88) 100%);}
.accent-yellow .ex-card-overlay{background:linear-gradient(to bottom,rgba(180,160,0,0.25) 0%,rgba(140,120,0,0.88) 100%);}
.accent-purple .ex-card-overlay{background:linear-gradient(to bottom,rgba(150,50,200,0.25) 0%,rgba(100,20,160,0.88) 100%);}
.accent-orange .ex-card-overlay{background:linear-gradient(to bottom,rgba(255,120,0,0.25) 0%,rgba(200,80,0,0.88) 100%);}
.accent-green .ex-card-overlay{background:linear-gradient(to bottom,rgba(0,200,100,0.25) 0%,rgba(0,140,60,0.88) 100%);}
.tp-empty{padding:60px;text-align:center;color:rgba(255,255,255,0.3);font-size:14px;background:#111114;border-radius:20px;border:1px solid rgba(255,255,255,0.06);}
.add-plan-banner{background:linear-gradient(135deg,rgba(233,30,140,0.1),rgba(0,212,255,0.1));border:1px dashed rgba(255,255,255,0.15);border-radius:20px;padding:40px;text-align:center;margin-bottom:24px;}
.add-plan-banner h3{color:#fff;margin-bottom:8px;}
.add-plan-banner p{color:rgba(255,255,255,0.4);font-size:14px;margin-bottom:20px;}
.add-plan-btn{display:inline-block;padding:12px 28px;background:#e91e8c;color:#fff;border-radius:20px;text-decoration:none;font-size:13px;font-weight:700;}
.return-btn{display:inline-flex;align-items:center;gap:8px;margin-top:32px;padding:12px 28px;border-radius:20px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.7);text-decoration:none;font-size:14px;}
.log-modal-bg{position:fixed;inset:0;background:rgba(0,0,0,0.8);z-index:9999;display:none;align-items:center;justify-content:center;}
.log-modal-bg.open{display:flex;}
.log-modal{background:#1a1a1f;border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:32px;width:90%;max-width:420px;}
.log-modal h3{color:#fff;margin-bottom:20px;}
.log-field{margin-bottom:16px;}
.log-field label{display:block;font-size:12px;color:rgba(255,255,255,0.5);margin-bottom:6px;text-transform:uppercase;}
.log-field input,.log-field textarea{width:100%;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:10px 14px;color:#fff;font-size:14px;outline:none;}
.log-btns{display:flex;gap:10px;margin-top:20px;}
.log-submit{flex:1;padding:12px;background:#e91e8c;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;}
.log-cancel{flex:1;padding:12px;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.7);border:1px solid rgba(255,255,255,0.1);border-radius:10px;font-size:14px;cursor:pointer;}
@media(max-width:768px){.ex-card-new{flex:0 0 calc(80% - 8px);}.cal-strip{justify-content:center;flex-wrap:wrap;}.muscle-header{flex-direction:column;align-items:flex-start;}}
</style>
<div id="xd-workout-page">
  <div class="cal-strip" id="cal-strip"></div>
  <div id="tp-content"><div style="padding:60px;text-align:center;color:rgba(255,255,255,0.3)">Loading workout plans...</div></div>
  <div style="text-align:center;"><a href="<?php echo home_url('/'); ?>" class="return-btn">← Return to Dashboard</a></div>
</div>
<div class="log-modal-bg" id="log-modal">
  <div class="log-modal">
    <h3 id="modal-ex-name">Log Exercise</h3>
    <input type="hidden" id="modal-plan-id"><input type="hidden" id="modal-muscle"><input type="hidden" id="modal-ex">
    <div class="log-field"><label>Sets Done</label><input type="number" id="log-sets" value="3" min="1"></div>
    <div class="log-field"><label>Reps Done</label><input type="number" id="log-reps" value="12" min="1"></div>
    <div class="log-field"><label>Weight (kg)</label><input type="number" id="log-weight" value="0" step="0.5"></div>
    <div class="log-field"><label>Notes</label><textarea id="log-notes" rows="2" placeholder="How did it feel?"></textarea></div>
    <div class="log-btns"><button class="log-cancel" onclick="closeModal()">Cancel</button><button class="log-submit" onclick="submitLog()">Log It</button></div>
  </div>
</div>
<script>
const REST='<?php echo esc_js(rest_url("trainopro/v1/")); ?>';
const NONCE='<?php echo wp_create_nonce("wp_rest"); ?>';
const ACCENTS=['accent-pink','accent-blue','accent-yellow','accent-purple','accent-orange','accent-green'];
const BADGE_COLORS=['#e91e8c','#9c27b0','#ff9800','#4caf50','#2196f3','#00bcd4'];
const IMGS=['https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=400&q=80','https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=400&q=80','https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?w=400&q=80','https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400&q=80','https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=400&q=80','https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?w=400&q=80'];
function buildCalendar(){const days=['MON','TUE','WED','THU','FRI','SAT','SUN'];const today=new Date();const dow=today.getDay();const off=dow===0?-6:1-dow;document.getElementById('cal-strip').innerHTML=days.map((d,i)=>{const dt=new Date(today);dt.setDate(today.getDate()+off+i);const isToday=dt.toDateString()===today.toDateString();return '<div class="cal-day'+(isToday?' active':'')+'" onclick="selectDay(this)"><span class="d-name">'+d+'</span><span class="d-num">'+dt.getDate()+'</span><div class="d-dots"><span></span><span></span><span></span></div></div>';}).join('');}
function selectDay(el){document.querySelectorAll('.cal-day').forEach(d=>d.classList.remove('active'));el.classList.add('active');}
async function loadPlans(){try{const r=await fetch(REST+'plans',{headers:{'X-WP-Nonce':NONCE}});const plans=await r.json();renderPlans(plans);}catch(e){document.getElementById('tp-content').innerHTML='<div class="tp-empty">Could not connect to TrainoPro plugin.</div>';}}
function renderPlans(plans){const el=document.getElementById('tp-content');if(!plans||plans.length===0){el.innerHTML='<div class="add-plan-banner"><h3>No Workout Plans Yet</h3><p>Add your first workout plan from the TrainoPro admin panel.</p><a href="/wp-admin/admin.php?page=tp-add-plan" class="add-plan-btn">+ Add Workout Plan</a></div>';return;}el.innerHTML=plans.map((plan,pi)=>{const ai=pi%ACCENTS.length;const exercises=plan.exercise_list||[];const mg=(plan.muscle_group||plan.plan_name||'WORKOUT').toUpperCase();const tid='track-'+pi;const cal=plan.calories_est||(exercises.length*40)||20;const dur=plan.duration_min||(exercises.length*5)||20;const cards=exercises.length>0?exercises.map((ex,ei)=>'<div class="ex-card-new '+ACCENTS[ei%ACCENTS.length]+'"><img class="ex-card-img" src="'+IMGS[ei%IMGS.length]+'" alt="'+ex.name+'" loading="lazy"><div class="ex-card-overlay"></div><div class="ex-card-body"><div class="ex-card-title">'+ex.name+'</div><div class="ex-card-meta">'+ex.sets+' sets &bull; '+ex.reps+' reps &bull; '+(ex.target_weight||'Bodyweight')+'</div></div></div>').join(''):'<div class="tp-empty" style="min-width:100%">No exercises added yet.</div>';return '<div class="muscle-section"><div class="muscle-header"><span class="muscle-badge" style="background:'+BADGE_COLORS[ai]+'">'+mg+'</span><div class="stats-pills"><div class="stat-pill">Total calories burned <b>'+cal+'</b></div><div class="stat-pill">Total Time <b>'+dur+':00</b></div></div></div><div class="carousel-wrap"><button class="carousel-btn" onclick="slide(\''+tid+'\',-1,'+exercises.length+')">&#9665;</button><div class="carousel-track-wrap"><div class="carousel-track" id="'+tid+'">'+cards+'</div></div><button class="carousel-btn" onclick="slide(\''+tid+'\',1,'+exercises.length+')">&#9655;</button></div></div>';}).join('');}
function slide(tid,dir,total){const t=document.getElementById(tid);if(!t)return;const vis=window.innerWidth<768?1:3;t._c=Math.min(Math.max((t._c||0)+dir,0),Math.max(0,total-vis));const w=(t.querySelector('.ex-card-new')?.offsetWidth||0)+16;t.style.transform='translateX(-'+t._c*w+'px)';}
function openModal(e,planId,muscle,exName){e.stopPropagation();document.getElementById('modal-plan-id').value=planId;document.getElementById('modal-muscle').value=muscle;document.getElementById('modal-ex').value=exName;document.getElementById('modal-ex-name').textContent='Log: '+exName;document.getElementById('log-modal').classList.add('open');}
function closeModal(){document.getElementById('log-modal').classList.remove('open');}
async function submitLog(){const btn=document.querySelector('.log-submit');btn.textContent='Saving...';btn.disabled=true;const payload={plan_id:document.getElementById('modal-plan-id').value,muscle_group:document.getElementById('modal-muscle').value,exercise:document.getElementById('modal-ex').value,sets_done:parseInt(document.getElementById('log-sets').value)||0,reps_done:parseInt(document.getElementById('log-reps').value)||0,weight_start:parseFloat(document.getElementById('log-weight').value)||0,notes:document.getElementById('log-notes').value,log_date:new Date().toISOString().split('T')[0],calories_burn:40,duration_min:5};try{const r=await fetch(REST+'log',{method:'POST',headers:{'Content-Type':'application/json','X-WP-Nonce':NONCE},body:JSON.stringify(payload)});const res=await r.json();closeModal();showToast(res.success?'Exercise logged!':'Error saving.');}catch(e){showToast('Connection error.');}btn.textContent='Log It';btn.disabled=false;}
function showToast(msg){const t=document.createElement('div');t.style.cssText='position:fixed;bottom:30px;left:50%;transform:translateX(-50%);background:#00d4ff;color:#000;padding:12px 24px;border-radius:20px;font-weight:700;font-size:14px;z-index:99999;';t.textContent=msg;document.body.appendChild(t);setTimeout(()=>{t.style.opacity='0';setTimeout(()=>t.remove(),300);},3000);}
document.getElementById('log-modal').addEventListener('click',function(e){if(e.target===this)closeModal();});
document.addEventListener('DOMContentLoaded',()=>{buildCalendar();loadPlans();});
</script>
<?php get_footer(); ?>
