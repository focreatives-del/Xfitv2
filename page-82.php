<?php
/**
 * Template Name: Workout View
 */
get_header();
$chest_url = home_url('/index.php/chest-workout/');
global $wpdb;
$rows = $wpdb->get_results("SELECT id,plan_name,muscle_group,duration_min,calories_est FROM {$wpdb->prefix}tp_workout_plans ORDER BY id DESC");
$exrows = $wpdb->get_results("SELECT id,exercises FROM {$wpdb->prefix}tp_workout_plans ORDER BY id DESC");
$exmap = [];
foreach($exrows as $r){
  $exs=[];
  foreach(explode("\n",str_replace("\r","",$r->exercises??'')) as $l){
    $p=array_map('trim',explode('|',$l));
    if(!empty($p[0]))$exs[]=['n'=>$p[0],'s'=>$p[1]??'3','r'=>$p[2]??'10','w'=>$p[3]??'BW'];
  }
  $exmap[$r->id]=$exs;
}
$out=[];
foreach($rows as $r) $out[]=['id'=>(int)$r->id,'nm'=>$r->plan_name,'mg'=>$r->muscle_group,'cal'=>(int)$r->calories_est,'dur'=>(int)$r->duration_min,'ex'=>$exmap[$r->id]??[]];
?><!DOCTYPE html>
<style>
*{box-sizing:border-box}
#wp{background:#09090c;min-height:100vh;padding:90px 24px 60px}
.cs{display:flex;justify-content:flex-end;gap:8px;margin-bottom:28px}
.cd{display:flex;flex-direction:column;align-items:center;justify-content:center;width:52px;height:64px;border-radius:14px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);cursor:pointer}
.cd.ac{background:rgba(233,30,140,.18);border-color:#e91e8c}
.cd .dn{font-size:10px;color:rgba(255,255,255,.4);text-transform:uppercase;margin-bottom:4px}
.cd .dd{font-size:18px;font-weight:700;color:#fff}
.cd.ac .dd{color:#e91e8c}
.ms{background:#111114;border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:24px;margin-bottom:24px}
.mh{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px}
.mb{font-size:12px;font-weight:700;letter-spacing:2px;padding:6px 18px;border-radius:20px;text-transform:uppercase;color:#fff}
.sp{display:flex;border:1px solid rgba(255,255,255,.15);border-radius:8px;overflow:hidden}
.sp div{padding:8px 16px;font-size:12px;color:rgba(255,255,255,.7);background:rgba(255,255,255,.04);white-space:nowrap}
.sp div:not(:last-child){border-right:1px solid rgba(255,255,255,.15)}
.sp b{color:#fff;margin-left:4px}
.cw{display:flex;align-items:center;gap:12px}
.cb{width:44px;height:44px;border-radius:50%;background:rgba(80,60,140,.7);border:none;color:#fff;font-size:16px;cursor:pointer;flex-shrink:0}
.ctw{flex:1;overflow:hidden;border-radius:16px}
.ct{display:flex;gap:16px;transition:transform .4s ease}
a.ec{flex:0 0 calc(33.333% - 11px);border-radius:20px;overflow:hidden;position:relative;min-height:280px;display:block;text-decoration:none}
a.ec:hover{transform:translateY(-4px);transition:transform .2s}
.ei{width:100%;height:280px;object-fit:cover;display:block}
.eo{position:absolute;inset:0;pointer-events:none}
.eb{position:absolute;bottom:0;left:0;right:0;padding:20px 16px;pointer-events:none}
.et{font-size:16px;font-weight:800;color:#fff;margin-bottom:6px}
.em{font-size:11px;color:rgba(255,255,255,.7)}
.c0 .eo{background:linear-gradient(to bottom,rgba(233,30,140,.2),rgba(180,10,100,.9))}
.c1 .eo{background:linear-gradient(to bottom,rgba(0,150,255,.2),rgba(0,100,200,.9))}
.c2 .eo{background:linear-gradient(to bottom,rgba(180,160,0,.2),rgba(140,120,0,.9))}
.c3 .eo{background:linear-gradient(to bottom,rgba(150,50,200,.2),rgba(100,20,160,.9))}
.c4 .eo{background:linear-gradient(to bottom,rgba(255,120,0,.2),rgba(200,80,0,.9))}
.c5 .eo{background:linear-gradient(to bottom,rgba(0,200,100,.2),rgba(0,140,60,.9))}
.rb{display:inline-flex;margin-top:32px;padding:12px 28px;border-radius:20px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.7);text-decoration:none;font-size:14px}
@media(max-width:768px){a.ec{flex:0 0 80%}.cs{justify-content:center;flex-wrap:wrap}}
</style>
<div id="wp">
<div class="cs" id="cs"></div>
<div id="tc"></div>
<div style="text-align:center"><a href="<?php echo home_url('/'); ?>" class="rb">Back to Dashboard</a></div>
</div>
<script>
var D=<?php echo json_encode($out,JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP); ?>;
var W="<?php echo esc_js($chest_url); ?>";
var I=["https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=400","https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=400","https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?w=400","https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400","https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=400","https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?w=400"];
var BC=["#e91e8c","#9c27b0","#ff9800","#4caf50","#2196f3","#00bcd4"];
function buildCal(){
  var dy=["MON","TUE","WED","THU","FRI","SAT","SUN"],t=new Date(),dw=t.getDay(),of=dw===0?-6:1-dw,h="";
  for(var i=0;i<7;i++){var d=new Date(t);d.setDate(t.getDate()+of+i);var it=d.toDateString()===t.toDateString();h+='<div class="cd'+(it?" ac":"")+'"><span class="dn">'+dy[i]+'</span><span class="dd">'+d.getDate()+'</span></div>';}
  document.getElementById("cs").innerHTML=h;
}
function render(){
  var el=document.getElementById("tc");
  if(!D||!D.length){el.innerHTML='<p style="color:rgba(255,255,255,.3);padding:40px;text-align:center">No plans yet.</p>';return;}
  var h="";
  for(var i=0;i<D.length;i++){
    var p=D[i],ex=p.ex||[],mg=(p.mg||p.nm||"WORKOUT").toUpperCase(),cal=p.cal||(ex.length*40)||20,dur=p.dur||(ex.length*5)||20,cards="";
    for(var j=0;j<ex.length;j++){
      var e=ex[j],img=I[j%I.length],href=W+"?plan_id="+p.id;
      cards+='<a href="'+href+'" class="ec c'+(j%6)+'"><img class="ei" src="'+img+'" loading="lazy"><div class="eo"></div><div class="eb"><div class="et">'+e.n+'</div><div class="em">'+e.s+' sets &bull; '+e.r+' reps &bull; '+e.w+'</div></div></a>';
    }
    if(!cards)cards='<div style="padding:20px;color:rgba(255,255,255,.3)">No exercises.</div>';
    h+='<div class="ms"><div class="mh"><span class="mb" style="background:'+BC[i%6]+'">'+mg+'</span><div class="sp"><div>Calories <b>'+cal+'</b></div><div>Time <b>'+dur+':00</b></div></div></div><div class="cw"><button class="cb" data-t="tr'+i+'" data-d="-1" data-n="'+ex.length+'">&#9665;</button><div class="ctw"><div class="ct" id="tr'+i+'">'+cards+'</div></div><button class="cb" data-t="tr'+i+'" data-d="1" data-n="'+ex.length+'">&#9655;</button></div></div>';
  }
  el.innerHTML=h;
  document.querySelectorAll(".cb").forEach(function(b){b.addEventListener("click",function(){slide(this.dataset.t,+this.dataset.d,+this.dataset.n);});});
}
function slide(tid,dir,n){var t=document.getElementById(tid);if(!t)return;var v=window.innerWidth<768?1:3;t._c=Math.min(Math.max((t._c||0)+dir,0),Math.max(0,n-v));var c=t.querySelector(".ec");t.style.transform="translateX(-"+((c?c.offsetWidth+16:0)*t._c)+"px)";}
document.addEventListener("DOMContentLoaded",function(){buildCal();render();});
</script>
<?php get_footer(); ?>
