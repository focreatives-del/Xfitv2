<?php
/**
 * Template Name: Workout View
 */
get_header();
?>
<style>
#xd-workout-page{background:#09090c;min-height:100vh;padding:100px 24px 60px;}
.cal-strip{display:flex;justify-content:flex-end;gap:8px;margin-bottom:28px;}
.cal-day{display:flex;flex-direction:column;align-items:center;width:52px;height:64px;border-radius:14px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);cursor:pointer;}
.cal-day.active{background:rgba(233,30,140,0.18);border-color:#e91e8c;}
.cal-day .d-name{font-size:10px;color:rgba(255,255,255,0.4);text-transform:uppercase;margin-top:10px;}
.cal-day .d-num{font-size:18px;font-weight:700;color:#fff;}
.cal-day.active .d-num{color:#e91e8c;}
.muscle-section{background:#111114;border:1px solid rgba(255,255,255,0.08);border-radius:20px;padding:24px;margin-bottom:24px;}
.muscle-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;}
.muscle-badge{font-size:12px;font-weight:700;letter-spacing:2px;padding:6px 18px;border-radius:20px;text-transform:uppercase;color:#fff;}
.stats-pills{display:flex;border:1px solid rgba(255,255,255,0.15);border-radius:8px;overflow:hidden;}
.stat-pill{padding:8px 16px;font-size:12px;color:rgba(255,255,255,0.7);background:rgba(255,255,255,0.04);}
.stat-pill b{color:#fff;margin-left:4px;}
.stat-pill:not(:last-child){border-right:1px solid rgba(255,255,255,0.15);}
.carousel-wrap{display:flex;align-items:center;gap:12px;}
.carousel-btn{width:44px;height:44px;border-radius:50%;background:rgba(80,60,140,0.7);border:none;color:#fff;font-size:16px;cursor:pointer;flex-shrink:0;}
.carousel-track-wrap{flex:1;overflow:hidden;border-radius:16px;}
.carousel-track{display:flex;gap:16px;transition:transform .4s ease;}
.ex-card-new{flex:0 0 calc(33.333% - 11px);border-radius:20px;overflow:hidden;position:relative;min-height:280px;}
.ex-card-img{width:100%;height:280px;object-fit:cover;display:block;}
.ex-card-overlay{position:absolute;inset:0;}
.ex-card-body{position:absolute;bottom:0;left:0;right:0;padding:20px 16px;}
.ex-card-title{font-size:16px;font-weight:800;color:#fff;margin-bottom:6px;}
.ex-card-meta{font-size:11px;color:rgba(255,255,255,0.7);margin-bottom:12px;}
.ex-card-btn{width:28px;height:28px;border-radius:50%;border:2px solid rgba(255,255,255,0.6);background:transparent;color:#fff;cursor:pointer;}
.accent-pink .ex-card-overlay{background:linear-gradient(to bottom,rgba(233,30,140,0.2),rgba(180,10,100,0.9));}
.accent-blue .ex-card-overlay{background:linear-gradient(to bottom,rgba(0,150,255,0.2),rgba(0,100,200,0.9));}
.accent-yellow .ex-card-overlay{background:linear-gradient(to bottom,rgba(180,160,0,0.2),rgba(140,120,0,0.9));}
.accent-purple .ex-card-overlay{background:linear-gradient(to bottom,rgba(150,50,200,0.2),rgba(100,20,160,0.9));}
.accent-orange .ex-card-overlay{background:linear-gradient(to bottom,rgba(255,120,0,0.2),rgba(200,80,0,0.9));}
.accent-green .ex-card-overlay{background:linear-gradient(to bottom,rgba(0,200,100,0.2),rgba(0,140,60,0.9));}
.return-btn{display:inline-flex;margin-top:32px;padding:12px 28px;border-radius:20px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.7);text-decoration:none;font-size:14px;}
.tp-empty{padding:60px;text-align:center;color:rgba(255,255,255,0.3);background:#111114;border-radius:20px;}
.add-plan-btn{display:inline-block;padding:12px 28px;background:#e91e8c;color:#fff;border-radius:20px;text-decoration:none;font-size:13px;font-weight:700;}
@media(max-width:768px){.ex-card-new{flex:0 0 80%;}}
</style>
<div id="xd-workout-page">
  <div class="cal-strip" id="cal-strip"></div>
  <div id="tp-content"><div class="tp-empty">Loading plans...</div></div>
  <div style="text-align:center"><a href="<?php echo home_url('/'); ?>" class="return-btn">← Dashboard</a></div>
</div>
<script>
var REST='<?php echo esc_js(rest_url("trainopro/v1/")); ?>';
var NONCE='<?php echo wp_create_nonce("wp_rest"); ?>';
var ACC=['accent-pink','accent-blue','accent-yellow','accent-purple','accent-orange','accent-green'];
var BC=['#e91e8c','#9c27b0','#ff9800','#4caf50','#2196f3','#00bcd4'];
var IM=['https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=400','https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=400','https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?w=400','https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400','https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=400','https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?w=400'];
function buildCal(){var days=['MON','TUE','WED','THU','FRI','SAT','SUN'];var today=new Date();var dow=today.getDay();var off=dow===0?-6:1-dow;var html='';for(var i=0;i<7;i++){var dt=new Date(today);dt.setDate(today.getDate()+off+i);var isTod=dt.toDateString()===today.toDateString();html+='<div class="cal-day'+(isTod?' active':'')+'" onclick="selDay(this)"><span class="d-name">'+days[i]+'</span><span class="d-num">'+dt.getDate()+'</span></div>';}document.getElementById('cal-strip').innerHTML=html;}
function selDay(el){document.querySelectorAll('.cal-day').forEach(function(d){d.classList.remove('active');});el.classList.add('active');}
function loadPlans(){fetch(REST+'plans',{headers:{'X-WP-Nonce':NONCE}}).then(function(r){return r.json();}).then(function(p){renderPlans(p);}).catch(function(){document.getElementById('tp-content').innerHTML='<div class="tp-empty">Could not load plans.</div>';});}
function renderPlans(plans){var el=document.getElementById('tp-content');if(!plans||plans.length===0){el.innerHTML='<div class="tp-empty"><p style="color:#fff;margin-bottom:16px">No Workout Plans Yet</p><a href="/wp-admin/admin.php?page=tp-add-plan" class="add-plan-btn">+ Add Plan</a></div>';return;}var html='';for(var pi=0;pi<plans.length;pi++){var plan=plans[pi];var ai=pi%ACC.length;var exs=plan.exercise_list||[];var mg=(plan.muscle_group||plan.plan_name||'WORKOUT').toUpperCase();var tid='t'+pi;var cal=plan.calories_est||(exs.length*40)||20;var dur=plan.duration_min||(exs.length*5)||20;var cards='';if(exs.length>0){for(var ei=0;ei<exs.length;ei++){var ex=exs[ei];cards+='<div class="ex-card-new '+ACC[ei%ACC.length]+'"><img class="ex-card-img" src="'+IM[ei%IM.length]+'" alt="'+ex.name+'" loading="lazy"><div class="ex-card-overlay"></div><div class="ex-card-body"><div class="ex-card-title">'+ex.name+'</div><div class="ex-card-meta">'+ex.sets+' sets &bull; '+ex.reps+' reps &bull; '+(ex.target_weight||'BW')+'</div></div></div>';}}else{cards='<div class="tp-empty" style="min-width:100%">No exercises yet.</div>';}html+='<div class="muscle-section"><div class="muscle-header"><span class="muscle-badge" style="background:'+BC[ai]+'">'+mg+'</span><div class="stats-pills"><div class="stat-pill">Calories <b>'+cal+'</b></div><div class="stat-pill">Time <b>'+dur+':00</b></div></div></div><div class="carousel-wrap"><button class="carousel-btn" onclick="slide(\''+tid+'\',-1,'+exs.length+')">&#9665;</button><div class="carousel-track-wrap"><div class="carousel-track" id="'+tid+'">'+cards+'</div></div><button class="carousel-btn" onclick="slide(\''+tid+'\',1,'+exs.length+')">&#9655;</button></div></div>';}el.innerHTML=html;}
function slide(tid,dir,total){var t=document.getElementById(tid);if(!t)return;var vis=window.innerWidth<768?1:3;if(!t._c)t._c=0;t._c=Math.min(Math.max(t._c+dir,0),Math.max(0,total-vis));var card=t.querySelector('.ex-card-new');var w=card?(card.offsetWidth+16):0;t.style.transform='translateX(-'+t._c*w+'px)';}
document.addEventListener('DOMContentLoaded',function(){buildCal();loadPlans();});
</script>
<?php get_footer(); ?>
