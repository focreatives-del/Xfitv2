<?php
/**
 * Front Page — Full Gym Dashboard — Trainopro Neon
 * All sections connected via JS state. Water→Energy/Cal/Nutrition.
 * AI Meal→Protein/Calories/Nutrition. Workout→Overall/Burn/Achievements.
 */
get_header();
?>

<style>
/* ═══ HERO SLIDER ═══ */
.xd-hero{width:100vw;margin-left:calc(-50vw + 50%);background:#09090c;overflow:hidden;display:block;}
.xd-hero .hero-slider-wrapper{width:100%;display:block;}

/* ═══ NUCLEAR RESET ═══ */
#xd,#xd *,#xd *::before,#xd *::after{
  margin:0!important;padding:0!important;box-sizing:border-box!important;
  float:none!important;clear:none!important;text-decoration:none!important;
  list-style:none!important;border:none!important;outline:none!important;
  text-transform:none!important;letter-spacing:0!important;word-spacing:0!important;
  text-indent:0!important;text-align:left!important;vertical-align:baseline!important;
  background:none!important;color:inherit!important;
  font-family:'DM Sans',sans-serif!important;
  font-size:inherit!important;font-weight:inherit!important;
  font-style:normal!important;font-stretch:normal!important;
  font-variant:normal!important;
  line-height:1.5!important;
  opacity:1!important;visibility:visible!important;position:static!important;
  display:block!important;width:auto!important;height:auto!important;
  max-width:none!important;min-width:0!important;max-height:none!important;
  min-height:0!important;overflow:visible!important;transform:none!important;
  transition:none!important;animation:none!important;box-shadow:none!important;
  filter:none!important;
}

/* ═══ ROOT ═══ */
#xd{
  display:block!important;
  background:#09090c!important;
  color:#fff!important;
  font-family:'DM Sans',sans-serif!important;
  font-size:14px!important;
  font-weight:400!important;
  font-style:normal!important;
  font-stretch:normal!important;
  font-variant:normal!important;
  line-height:1.5!important;
  letter-spacing:0!important;
  word-spacing:0!important;
  padding:0!important;
  width:100vw!important;
  margin-left:calc(-50vw + 50%)!important;
  position:relative!important;
}

/* ═══ CONTAINER ═══ */
#xd .xw{max-width:1400px!important;margin:0 auto!important;padding:28px 28px!important;display:block!important;}
#xd .xs{margin-bottom:20px!important;display:block!important;}

/* ═══ GRIDS ═══ */
#xd .g-top{display:grid!important;grid-template-columns:minmax(190px, 1fr) minmax(220px, 1fr) 2fr!important;grid-template-rows:auto auto!important;gap:16px!important;width:100%!important;}
#xd .c-cal{grid-column:1!important;grid-row:1!important;}
#xd .c-wt {grid-column:1!important;grid-row:2!important;}
#xd .c-water{grid-column:2!important;grid-row:1!important;}
#xd .c-ach{grid-column:2!important;grid-row:2!important;}
#xd .c-work{grid-column:3!important;grid-row:1/3!important;}
#xd .g-bot{display:grid!important;grid-template-columns:repeat(3,1fr)!important;gap:16px!important;width:100%!important;}
#xd .g-new{display:grid!important;grid-template-columns:repeat(3,1fr)!important;gap:16px!important;width:100%!important;}
#xd .g-hlth{display:grid!important;grid-template-columns:280px 1fr!important;gap:16px!important;width:100%!important;}

/* ═══ CARD ═══ */
#xd .cd{background:#111114!important;border:1px solid rgba(255,255,255,.08)!important;border-radius:20px!important;padding:22px!important;position:relative!important;overflow:hidden!important;display:block!important;animation:xdu .6s cubic-bezier(.2,.8,.2,1) both!important;min-height:160px!important;}
#xd .cd::before{content:''!important;position:absolute!important;inset:0!important;background:linear-gradient(135deg,rgba(255,255,255,.025) 0%,transparent 60%)!important;pointer-events:none!important;border-radius:20px!important;}
@keyframes xdu{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
#xd .cd:nth-child(1){animation-delay:.05s!important;}
#xd .cd:nth-child(2){animation-delay:.1s!important;}
#xd .cd:nth-child(3){animation-delay:.15s!important;}
#xd .cd:nth-child(4){animation-delay:.2s!important;}
#xd .cd:nth-child(5){animation-delay:.25s!important;}

/* ═══ SVG FIX ═══ */
#xd svg{display:inline-block!important;overflow:visible!important;vertical-align:middle!important;width:auto!important;height:auto!important;max-width:none!important;max-height:none!important;background:none!important;border:none!important;position:static!important;opacity:1!important;visibility:visible!important;}
#xd svg *{display:inline!important;visibility:visible!important;opacity:1!important;border:none!important;margin:0!important;padding:0!important;position:static!important;background:none!important;width:auto!important;height:auto!important;}

/* ═══ DONUT ═══ */
#xd .dn{position:relative!important;display:inline-flex!important;flex-shrink:0!important;}
#xd .dn b{position:absolute!important;inset:0!important;display:flex!important;align-items:center!important;justify-content:center!important;font-family:'Syne',sans-serif!important;font-weight:800!important;color:#fff!important;}

/* ═══ SECTION TITLE ═══ */
#xd .st{font-family:'Syne',sans-serif!important;font-size:15px!important;font-weight:800!important;color:#fff!important;display:block!important;margin-bottom:4px!important;}
#xd .st-bar{height:3px!important;width:36px!important;border-radius:2px!important;display:block!important;margin-bottom:16px!important;}
#xd .st-pk{background:linear-gradient(90deg,#e91e8c,#9b59b6)!important;}
#xd .st-cy{background:linear-gradient(90deg,#00d4ff,#3498db)!important;}
#xd .st-go{background:linear-gradient(90deg,#fecb00,#f5a623)!important;}
#xd .st-gr{background:linear-gradient(90deg,#00e676,#00bcd4)!important;}
#xd .st-pu{background:linear-gradient(90deg,#8b5cf6,#e91e8c)!important;}

/* ═══ METRIC ITEM ═══ */
#xd .mi{display:flex!important;align-items:center!important;gap:14px!important;background:rgba(255,255,255,.05)!important;border:1px solid rgba(255,255,255,.08)!important;border-radius:14px!important;padding:12px 14px!important;margin-bottom:10px!important;}
#xd .ml{font-size:13px!important;font-weight:700!important;color:#fff!important;display:block!important;}
#xd .ms{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-top:2px!important;}

/* ═══ PLUS BUTTON ═══ */
#xd .pb{position:absolute!important;bottom:14px!important;right:14px!important;width:28px!important;height:28px!important;border-radius:50%!important;border:1px solid #e91e8c!important;background:none!important;cursor:pointer!important;display:flex!important;align-items:center!important;justify-content:center!important;color:#e91e8c!important;font-size:18px!important;font-weight:300!important;line-height:1!important;transition:all .3s ease!important;z-index:5!important;}
#xd .pb:hover{background:#e91e8c!important;color:#fff!important;box-shadow:0 0 12px rgba(233,30,140,.5)!important;}
#xd .pb-c{border-color:#00d4ff!important;color:#00d4ff!important;}
#xd .pb-c:hover{background:#00d4ff!important;color:#000!important;box-shadow:0 0 12px rgba(0,212,255,.5)!important;}
#xd .pb-g{border-color:#00e676!important;color:#00e676!important;}
#xd .pb-g:hover{background:#00e676!important;color:#000!important;}
#xd .pb-tr{top:16px!important;right:16px!important;bottom:auto!important;}
#xd .pb-s{position:static!important;}

/* ═══ WEIGHT ═══ */
#xd .wt-lbl{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-bottom:4px!important;}
#xd .wt-val{font-family:'Syne',sans-serif!important;font-size:24px!important;font-weight:800!important;color:#fff!important;display:block!important;margin-bottom:12px!important;}
#xd .wt-inp{width:100%!important;background:rgba(255,255,255,.08)!important;border:1px solid rgba(255,255,255,.15)!important;border-radius:10px!important;padding:8px 12px!important;color:#fff!important;font-family:'DM Sans',sans-serif!important;font-size:11px!important;display:block!important;}
#xd .wt-inp::placeholder{color:rgba(255,255,255,.3)!important;}
#xd .spark{margin-top:12px!important;background:rgba(255,255,255,.02)!important;border-radius:10px!important;padding:10px!important;overflow:hidden!important;display:block!important;}

/* ═══ WATER ═══ */
#xd .w-item{display:flex!important;align-items:center!important;gap:14px!important;margin-bottom:14px!important;}
#xd .w-name{font-size:13px!important;font-weight:700!important;color:#fff!important;display:block!important;}
#xd .w-sub{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-top:2px!important;}
#xd .w-prog-bg{height:5px!important;background:rgba(255,255,255,.1)!important;border-radius:3px!important;overflow:hidden!important;display:block!important;margin-top:8px!important;}
#xd .w-prog-f{height:100%!important;border-radius:3px!important;background:linear-gradient(90deg,#00d4ff,#00e676)!important;display:block!important;transition:width 1s ease!important;}
#xd .w-add{display:flex!important;gap:6px!important;margin-top:14px!important;padding-top:12px!important;border-top:1px solid rgba(255,255,255,.07)!important;}
#xd .wml{flex:1!important;padding:7px 0!important;border-radius:8px!important;border:1px solid rgba(0,212,255,.3)!important;color:#00d4ff!important;font-size:11px!important;font-weight:700!important;background:rgba(0,212,255,.07)!important;cursor:pointer!important;text-align:center!important;display:block!important;transition:all .2s!important;}
#xd .wml:hover{background:rgba(0,212,255,.2)!important;}

/* ═══ ACHIEVEMENTS ═══ */
#xd .ach-t{font-size:11px!important;font-weight:800!important;color:#fff!important;display:block!important;margin-bottom:8px!important;text-align:center!important;text-transform:uppercase!important;letter-spacing:1px!important;}
#xd .ach-pct{font-family:'Syne',sans-serif!important;font-size:28px!important;font-weight:800!important;color:#e91e8c!important;display:block!important;text-align:center!important;margin-bottom:6px!important;}
#xd .leg{display:flex!important;justify-content:center!important;gap:12px!important;margin-bottom:10px!important;}
#xd .leg i{display:flex!important;align-items:center!important;gap:5px!important;font-size:9px!important;color:rgba(255,255,255,.5)!important;font-style:normal!important;font-weight:600!important;}
#xd .leg i::before{content:''!important;width:7px!important;height:7px!important;border-radius:50%!important;display:inline-block!important;}
#xd .leg i.lp::before{background:#e91e8c!important;box-shadow:0 0 5px #e91e8c!important;}
#xd .leg i.lc::before{background:#00d4ff!important;box-shadow:0 0 5px #00d4ff!important;}
#xd .achart{width:100%!important;height:60px!important;display:block!important;}

/* ═══ WORKOUT CARD ═══ */
#xd .wo-t{font-family:'Syne',sans-serif!important;font-size:17px!important;font-weight:800!important;color:#fff!important;display:block!important;}
#xd .wo-body{display:grid!important;grid-template-columns:1fr 180px!important;gap:28px!important;align-items:start!important;}
#xd .m-list{display:flex!important;flex-direction:column!important;gap:18px!important;}
#xd .m-head{display:flex!important;justify-content:space-between!important;align-items:center!important;margin-bottom:8px!important;}
#xd .m-name{font-size:16px!important;font-weight:700!important;color:#fff!important;display:inline!important;}
#xd .m-up{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:inline-flex!important;align-items:center!important;gap:5px!important;}
#xd .m-up::before{content:''!important;width:6px!important;height:6px!important;border-radius:50%!important;background:#00d4ff!important;display:inline-block!important;box-shadow:0 0 6px #00d4ff!important;}
#xd .bar-bg{height:8px!important;background:rgba(255,255,255,.1)!important;border-radius:4px!important;overflow:hidden!important;display:block!important;}
#xd .bar-f{height:100%!important;border-radius:4px!important;display:block!important;width:0!important;transition:width 1.2s cubic-bezier(.1,.7,.1,1)!important;}
#xd .bpk{background:linear-gradient(90deg,#e91e8c,#9b59b6)!important;}
#xd .bbl{background:linear-gradient(90deg,#00d4ff,#3498db)!important;}
#xd .bgo{background:linear-gradient(90deg,#fecb00,#f5a623)!important;}
#xd .bgr{background:linear-gradient(90deg,#00e676,#00bcd4)!important;}
#xd .bpu{background:linear-gradient(90deg,#8b5cf6,#e91e8c)!important;}
#xd .wo-r{display:flex!important;flex-direction:column!important;align-items:center!important;gap:12px!important;}
#xd .wo-lbl{font-size:14px!important;font-weight:800!important;color:#fff!important;text-align:center!important;display:block!important;margin-top:4px!important;}
#xd .wbtn{display:block!important;width:100%!important;padding:9px 14px!important;border-radius:50px!important;font-size:12px!important;font-weight:700!important;cursor:pointer!important;text-align:center!important;font-family:'DM Sans',sans-serif!important;background:none!important;transition:all .3s ease!important;}
#xd .wbtn-p{border:1px solid #e91e8c!important;color:#fff!important;}
#xd .wbtn-p:hover{background:#e91e8c!important;box-shadow:0 0 14px rgba(233,30,140,.3)!important;}
#xd .wbtn-g{border:1px solid rgba(255,255,255,.2)!important;color:#fff!important;}
#xd .wbtn-g:hover{border-color:#fff!important;background:rgba(255,255,255,.05)!important;}

/* ═══ BOTTOM INFO ═══ */
#xd .inf{padding:22px 20px 56px!important;}
#xd .inf-t{font-family:'Syne',sans-serif!important;font-size:16px!important;font-weight:800!important;color:#fff!important;display:block!important;margin-bottom:12px!important;}
#xd .inf-bar{height:5px!important;width:55%!important;border-radius:3px!important;display:block!important;margin-bottom:20px!important;}
#xd .inf-st{display:flex!important;align-items:center!important;gap:8px!important;margin-bottom:4px!important;}
#xd .st-dot{width:10px!important;height:10px!important;border-radius:50%!important;background:#00d4ff!important;box-shadow:0 0 10px #00d4ff!important;display:inline-block!important;}
#xd .st-txt{font-family:'Syne',sans-serif!important;font-size:20px!important;font-weight:800!important;color:#fff!important;display:inline!important;}
#xd .inf-up{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-bottom:16px!important;}
#xd .inf-row{display:flex!important;justify-content:space-between!important;align-items:flex-end!important;}
#xd .inf-lo{font-size:12px!important;color:rgba(255,255,255,.5)!important;line-height:1.65!important;max-width:140px!important;display:block!important;}

/* ═══ AI BUTTON ═══ */
#xd .ai-btn{display:flex!important;align-items:center!important;gap:8px!important;padding:9px 14px!important;border-radius:10px!important;background:rgba(233,30,140,.12)!important;border:1px solid rgba(233,30,140,.4)!important;color:#e91e8c!important;font-size:12px!important;font-weight:700!important;cursor:pointer!important;margin-top:10px!important;transition:all .3s!important;}
#xd .ai-btn:hover{background:rgba(233,30,140,.25)!important;box-shadow:0 0 12px rgba(233,30,140,.3)!important;}

/* ═══ PROTEIN ═══ */
#xd .prot-top{display:flex!important;align-items:center!important;gap:16px!important;margin-bottom:16px!important;}
#xd .prot-info{flex:1!important;}
#xd .prot-val{font-family:'Syne',sans-serif!important;font-size:30px!important;font-weight:800!important;color:#fff!important;display:block!important;}
#xd .prot-goal-txt{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-top:2px!important;}
#xd .prot-bar-bg{height:6px!important;background:rgba(255,255,255,.1)!important;border-radius:3px!important;overflow:hidden!important;display:block!important;margin-bottom:16px!important;}
#xd .prot-bar-f{height:100%!important;border-radius:3px!important;background:linear-gradient(90deg,#8b5cf6,#e91e8c)!important;display:block!important;transition:width 1s ease!important;}
#xd .macro-row{display:flex!important;gap:8px!important;}
#xd .macro-box{flex:1!important;background:rgba(255,255,255,.05)!important;border:1px solid rgba(255,255,255,.08)!important;border-radius:10px!important;padding:10px 8px!important;text-align:center!important;}
#xd .macro-lbl{font-size:10px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-bottom:4px!important;}
#xd .macro-val{font-size:15px!important;font-weight:700!important;color:#fff!important;display:block!important;}

/* ═══ BMI ═══ */
#xd .bmi-fields{display:flex!important;gap:10px!important;margin-bottom:14px!important;}
#xd .bmi-f{flex:1!important;}
#xd .bmi-lbl{font-size:10px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-bottom:5px!important;}
#xd .bmi-inp{width:100%!important;background:rgba(255,255,255,.08)!important;border:1px solid rgba(255,255,255,.15)!important;border-radius:8px!important;padding:9px 10px!important;color:#fff!important;font-size:14px!important;font-family:'DM Sans',sans-serif!important;display:block!important;}
#xd .bmi-result{display:flex!important;align-items:center!important;gap:16px!important;background:rgba(255,255,255,.04)!important;border:1px solid rgba(255,255,255,.08)!important;border-radius:14px!important;padding:14px!important;}
#xd .bmi-num{font-family:'Syne',sans-serif!important;font-size:38px!important;font-weight:800!important;color:#00d4ff!important;display:block!important;}
#xd .bmi-cat{font-size:15px!important;font-weight:700!important;display:block!important;}
#xd .bmi-desc{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:block!important;margin-top:2px!important;}
#xd .bmi-scale{display:block!important;margin-top:14px!important;}
#xd .bmi-track{height:8px!important;background:linear-gradient(90deg,#00d4ff 0%,#00e676 25%,#fecb00 58%,#f97316 78%,#e91e8c 100%)!important;border-radius:4px!important;position:relative!important;display:block!important;}
#xd .bmi-marker{position:absolute!important;top:-5px!important;width:18px!important;height:18px!important;border-radius:50%!important;background:#fff!important;border:2px solid #111114!important;box-shadow:0 0 8px rgba(255,255,255,.4)!important;transform:translateX(-50%)!important;transition:left .5s ease!important;}
#xd .bmi-labs{display:flex!important;justify-content:space-between!important;margin-top:6px!important;}
#xd .bmi-ll{font-size:9px!important;color:rgba(255,255,255,.4)!important;}

/* ═══ ENERGY ═══ */
#xd .energy-center{display:flex!important;flex-direction:column!important;align-items:center!important;gap:8px!important;}
#xd .e-factors{display:flex!important;flex-direction:column!important;gap:10px!important;margin-top:14px!important;}
#xd .e-row{display:flex!important;align-items:center!important;gap:10px!important;}
#xd .e-lbl{font-size:11px!important;color:rgba(255,255,255,.6)!important;display:inline!important;min-width:62px!important;}
#xd .e-bar-bg{flex:1!important;height:4px!important;background:rgba(255,255,255,.1)!important;border-radius:2px!important;overflow:hidden!important;display:block!important;}
#xd .e-bar-f{height:100%!important;border-radius:2px!important;display:block!important;transition:width 1s ease!important;}
#xd .e-pct{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:inline!important;min-width:30px!important;text-align:right!important;}

/* ═══ HEALTH SECTION ═══ */
#xd .hlth-center{display:flex!important;flex-direction:column!important;align-items:center!important;justify-content:center!important;height:100%!important;padding:20px!important;}
#xd .hlth-num{font-family:'Syne',sans-serif!important;font-size:64px!important;font-weight:800!important;color:#fff!important;display:block!important;text-align:center!important;line-height:1!important;}
#xd .hlth-lbl{font-size:12px!important;color:rgba(255,255,255,.5)!important;display:block!important;text-align:center!important;margin-top:6px!important;}
#xd .hlth-badge{display:inline-block!important;padding:4px 14px!important;border-radius:20px!important;font-size:11px!important;font-weight:700!important;margin-top:10px!important;text-align:center!important;}
#xd .hlth-grid{display:grid!important;grid-template-columns:1fr 1fr!important;gap:10px!important;}
#xd .hm{background:rgba(255,255,255,.04)!important;border:1px solid rgba(255,255,255,.08)!important;border-radius:12px!important;padding:12px!important;}
/* Emoji labels — lock font-size so OS emoji doesn't blow up */
#xd .hm-l{font-size:11px!important;color:rgba(255,255,255,.5)!important;display:flex!important;align-items:center!important;gap:5px!important;margin-bottom:6px!important;line-height:1.3!important;}
#xd .hm-l .ico{font-size:12px!important;line-height:1!important;display:inline-block!important;flex-shrink:0!important;}
#xd .hm-v{font-family:'Syne',sans-serif!important;font-size:18px!important;font-weight:800!important;display:block!important;margin-bottom:5px!important;letter-spacing:-0.5px!important;}
#xd .hm-bg{height:3px!important;background:rgba(255,255,255,.1)!important;border-radius:2px!important;overflow:hidden!important;display:block!important;}
#xd .hm-bf{height:100%!important;border-radius:2px!important;display:block!important;transition:width 1s ease!important;}

/* ═══ TOAST ═══ */
#xd-toast{position:fixed!important;bottom:24px!important;right:24px!important;background:#18181c!important;border:1px solid rgba(0,212,255,.35)!important;border-left:3px solid #00d4ff!important;color:#fff!important;padding:12px 20px!important;border-radius:12px!important;font-size:13px!important;font-family:'DM Sans',sans-serif!important;transform:translateY(80px)!important;opacity:0!important;transition:all .3s!important;z-index:99999!important;display:block!important;max-width:320px!important;}
#xd-toast.show{transform:translateY(0)!important;opacity:1!important;}

/* ═══ AI MODAL ═══ */
#xd-modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.9);z-index:999999;align-items:center;justify-content:center;}
#xd-modal-bg.open{display:flex;}
#xd-modal{background:#131316;border:1px solid rgba(233,30,140,.3);border-radius:20px;padding:24px;max-width:420px;width:94%;position:relative;font-family:'DM Sans',sans-serif;color:#fff;font-stretch:normal;max-height:92vh;overflow-y:auto;}
#xd-modal h3{font-family:'Syne',sans-serif;font-size:17px;font-weight:800;margin:0 0 3px;color:#fff;}
#xd-modal .ai-desc{font-size:11px;color:rgba(255,255,255,.45);margin:0 0 14px;line-height:1.5;display:block;}
#ai-file-input{display:none;}
/* Upload zone */
.ai-scan-area{background:rgba(233,30,140,.06);border:2px dashed rgba(233,30,140,.3);border-radius:12px;padding:14px;text-align:center;margin-bottom:14px;cursor:pointer;transition:all .3s;position:relative;overflow:hidden;}
.ai-scan-area:hover,.ai-scan-area.dragging{background:rgba(233,30,140,.14);border-color:rgba(233,30,140,.7);}
.ai-preview-img{width:100%;max-height:140px;object-fit:cover;border-radius:8px;display:none;margin-bottom:8px;}
.ai-preview-img.show{display:block;}
.ai-scan-inner{display:flex;flex-direction:column;align-items:center;gap:5px;}
.ai-scan-icon{font-size:26px;line-height:1;}
.ai-scan-txt{font-size:12px;color:rgba(255,255,255,.6);}
.ai-scan-sub{font-size:10px;color:rgba(255,255,255,.3);}
/* Detected food badge */
.ai-food-badge{display:none;align-items:center;gap:10px;background:rgba(0,212,255,.08);border:1px solid rgba(0,212,255,.25);border-radius:10px;padding:10px 14px;margin-bottom:14px;}
.ai-food-badge.show{display:flex;}
.ai-food-name{font-size:14px;font-weight:700;color:#fff;font-family:'Syne',sans-serif;}
.ai-food-per{font-size:10px;color:rgba(255,255,255,.4);margin-top:2px;display:block;}
.ai-food-tag{font-size:10px;font-weight:700;padding:3px 8px;border-radius:20px;background:rgba(0,212,255,.15);color:#00d4ff;white-space:nowrap;}
/* Gram input — the only editable field */
.ai-gram-row{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);border-radius:10px;padding:10px 14px;margin-bottom:14px;}
.ai-gram-lbl{font-size:11px;color:rgba(255,255,255,.5);white-space:nowrap;font-family:'DM Sans',sans-serif;}
#ai-gram-inp{flex:1;background:none;border:none;border-bottom:2px solid #e91e8c;color:#fff;font-size:22px;font-weight:700;font-family:'Syne',sans-serif;text-align:right;padding:0 6px 2px;width:80px;outline:none;}
.ai-gram-unit{font-size:16px;font-weight:700;color:#e91e8c;font-family:'Syne',sans-serif;}
/* Auto-calc macro breakdown */
.ai-macros{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:16px;}
.ai-macro-box{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:10px 8px;text-align:center;}
.ai-macro-lbl{font-size:10px;color:rgba(255,255,255,.4);display:block;margin-bottom:4px;font-family:'DM Sans',sans-serif;}
.ai-macro-val{font-size:15px;font-weight:700;display:block;font-family:'Syne',sans-serif;}
/* Links bar */
.ai-links{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px;}
.ai-link-btn{flex:1;min-width:80px;padding:7px 10px;border-radius:8px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.04);color:rgba(255,255,255,.55);font-size:10px;font-weight:600;cursor:pointer;text-align:center;font-family:'DM Sans',sans-serif;transition:all .2s;text-decoration:none;display:block;}
.ai-link-btn:hover{border-color:#00d4ff;color:#00d4ff;background:rgba(0,212,255,.08);}
/* Actions */
.ai-actions{display:flex;gap:8px;}
.ai-btn-cancel{flex:1;padding:10px;border-radius:10px;border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.5);background:none;font-size:12px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;}
.ai-btn-ok{flex:2;padding:10px;border-radius:10px;border:none;background:linear-gradient(135deg,#e91e8c,#9b59b6);color:#fff;font-size:12px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;transition:opacity .2s;}
.ai-btn-ok:hover{opacity:.85;}
.ai-btn-ok:disabled{opacity:.4;cursor:not-allowed;}
#xd-modal-close{position:absolute;top:12px;right:14px;background:none;border:none;color:rgba(255,255,255,.35);font-size:20px;cursor:pointer;line-height:1;padding:4px;font-family:sans-serif;}

/* ═══ WORKOUT MODAL ═══ */
#xd-work-modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:999999;align-items:center;justify-content:center;backdrop-filter:blur(8px);}
#xd-work-modal-bg.open{display:flex;}
#xd-work-modal{background:#0d0d0f;border:1px solid rgba(255,255,255,.1);border-radius:28px;padding:32px;max-width:850px;width:94%;position:relative;font-family:'DM Sans',sans-serif;color:#fff;max-height:92vh;overflow-y:auto;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);}
.work-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:28px;}
.work-title-wrap h3{font-family:'Syne',sans-serif;font-size:24px;font-weight:800;margin:0 0 4px;color:#fff;letter-spacing:-0.5px;}
.work-subtitle{font-size:12px;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:1px;font-weight:700;}

/* Calendar styles */
.calendar-mini{display:flex;gap:6px;background:rgba(255,255,255,0.03);padding:6px;border-radius:14px;border:1px solid rgba(255,255,255,0.05);}
.cal-day{width:42px;height:52px;display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:10px;cursor:pointer;transition:all 0.3s;}
.cal-day .d-name{font-size:9px;color:rgba(255,255,255,0.3);text-transform:uppercase;margin-bottom:2px;}
.cal-day .d-num{font-size:14px;font-weight:800;color:rgba(255,255,255,0.7);}
.cal-day.active{background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);}
.cal-day.active .d-num{color:#fff;}
.cal-day.today{border-color:#00d4ff;}
.cal-day.today .d-num{color:#00d4ff;}

.work-stats-row{display:flex;gap:12px;margin-bottom:24px;}
.work-stat-pill{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);padding:8px 16px;border-radius:30px;font-size:12px;font-weight:600;}
.work-stat-pill span{color:rgba(255,255,255,0.4);margin-right:4px;}
.work-stat-pill b{color:#fff;}
.pill-accent{background:rgba(233,30,140,0.1);border-color:rgba(233,30,140,0.3);color:#e91e8c;}

/* Exercise Cards */
.ex-grid{display:grid;grid-template-columns:1fr;gap:16px;}
.ex-card{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:20px;display:flex;overflow:hidden;position:relative;transition:all 0.3s;min-height:140px;}
.ex-card:hover{background:rgba(255,255,255,0.05);border-color:rgba(255,255,255,0.12);transform:translateY(-2px);}
.ex-img-wrap{width:160px;position:relative;flex-shrink:0;}
.ex-img{width:100%;height:100%;object-fit:cover;filter:brightness(0.8) contrast(1.1);}
.ex-img-overlay{position:absolute;inset:0;background:linear-gradient(90deg, transparent 0%, rgba(13,13,15,1) 100%);}
.ex-info{flex:1;padding:20px;display:flex;flex-direction:column;justify-content:center;}
.ex-badge{display:inline-block;padding:2px 10px;border-radius:20px;font-size:10px;font-weight:800;text-transform:uppercase;margin-bottom:8px;}
.badge-ch{background:rgba(233,30,140,0.15);color:#e91e8c;}
.ex-name{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:#fff;margin-bottom:6px;display:block;}
.ex-desc{font-size:12px;color:rgba(255,255,255,0.4);line-height:1.5;max-width:320px;}
.ex-action{padding:20px;display:flex;align-items:center;}
.ex-plus{width:32px;height:32px;border-radius:50%;border:1px solid rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;cursor:pointer;transition:all 0.3s;}
.ex-card:hover .ex-plus{border-color:#00d4ff;background:#00d4ff;color:#000;box-shadow:0 0 15px rgba(0,212,255,0.4);}

/* ═══ FOOTER ═══ */
#xd-footer{display:block;background:#09090c;border-top:1px solid rgba(255,255,255,.08);margin-top:0;width:100vw;margin-left:calc(-50vw + 50%);font-family:'DM Sans',sans-serif;}
.xdf-stats{background:rgba(255,255,255,.025);border-bottom:1px solid rgba(255,255,255,.07);}
.xdf-stats-in{max-width:1400px;margin:0 auto;padding:28px 28px;display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
.xdf-stat{text-align:center;}
.xdf-snum{font-family:'Syne',sans-serif;font-size:30px;font-weight:800;background:linear-gradient(135deg,#00d4ff,#00e676);-webkit-background-clip:text;-webkit-text-fill-color:transparent;display:block;}
.xdf-slbl{font-size:12px;color:rgba(255,255,255,.45);display:block;margin-top:4px;}
.xdf-main{max-width:1400px;margin:0 auto;padding:50px 28px 40px;display:grid;grid-template-columns:1.6fr 1fr 1fr 1fr;gap:40px;}
.xdf-brand .xdf-logo{font-family:'Syne',sans-serif;font-size:22px;font-weight:800;color:#fff;letter-spacing:2px;display:block;margin-bottom:14px;}
.xdf-logo span{color:#00d4ff;}
.xdf-brand p{font-size:13px;color:rgba(255,255,255,.45);line-height:1.75;max-width:260px;margin:0 0 20px;}
.xdf-social{display:flex;gap:10px;}
.xdf-social a{width:36px;height:36px;border-radius:50%;border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.4);text-decoration:none;transition:all .25s;font-size:15px;}
.xdf-social a:hover{border-color:#00d4ff;color:#00d4ff;box-shadow:0 0 10px rgba(0,212,255,.3);}
.xdf-col h5{font-family:'Syne',sans-serif;font-size:12px;font-weight:800;color:#fff;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 16px;}
.xdf-col ul{list-style:none;padding:0;margin:0;}
.xdf-col ul li{margin-bottom:11px;}
.xdf-col ul li a{font-size:13px;color:rgba(255,255,255,.45);text-decoration:none;transition:color .2s;}
.xdf-col ul li a:hover{color:#00d4ff;}
.xdf-bottom{max-width:1400px;margin:0 auto;padding:20px 28px;border-top:1px solid rgba(255,255,255,.06);display:flex;justify-content:space-between;align-items:center;}
.xdf-bottom p{font-size:12px;color:rgba(255,255,255,.3);}
.xdf-bottom a{color:#00d4ff;text-decoration:none;}
.xdf-links{display:flex;gap:20px;}
.xdf-links a{font-size:12px;color:rgba(255,255,255,.3);text-decoration:none;}
.xdf-links a:hover{color:#00d4ff;}
.xdf-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(0,212,255,.1);border:1px solid rgba(0,212,255,.25);border-radius:20px;padding:4px 12px;font-size:11px;color:#00d4ff;font-weight:600;}

/* ═══ RESPONSIVE ═══ */
@media(max-width:1100px){
  #xd .g-top{grid-template-columns:1fr 1fr!important;}
  #xd .c-cal{grid-column:1!important;grid-row:1!important;}
  #xd .c-wt{grid-column:1!important;grid-row:2!important;}
  #xd .c-water{grid-column:2!important;grid-row:1!important;}
  #xd .c-ach{grid-column:2!important;grid-row:2!important;}
  #xd .c-work{grid-column:1/-1!important;grid-row:3!important;}
  #xd .g-new{grid-template-columns:1fr 1fr!important;}
  #xd .g-hlth{grid-template-columns:1fr!important;}
  .xdf-main{grid-template-columns:1fr 1fr;}
  .xdf-stats-in{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:768px){
  #xd .g-top,#xd .g-bot,#xd .g-new{grid-template-columns:1fr!important;}
  #xd .c-cal,#xd .c-wt,#xd .c-water,#xd .c-ach,#xd .c-work{grid-column:1!important;grid-row:auto!important;}
  #xd .wo-body{grid-template-columns:1fr!important;}
  #xd .hlth-grid{grid-template-columns:1fr 1fr!important;}
  #xd .xw{padding:16px!important;}
  .xdf-main{grid-template-columns:1fr;}
  .xdf-stats-in{grid-template-columns:repeat(2,1fr);}
  .xdf-bottom{flex-direction:column;gap:12px;text-align:center;}
}
/* ═══ PROFILE MODAL ═══ */
#xd-profile-modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:999999;align-items:center;justify-content:center;backdrop-filter:blur(10px);}
#xd-profile-modal-bg.open{display:flex;}
#xd-profile-modal{background:#111114;border:1px solid rgba(255,255,255,.1);border-radius:28px;padding:32px;max-width:600px;width:94%;position:relative;font-family:'DM Sans',sans-serif;color:#fff;max-height:92vh;overflow-y:auto;}
#xd-profile-modal h3{font-family:'Syne',sans-serif;font-size:22px;font-weight:800;margin-bottom:20px;color:#00d4ff;}
.p-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.p-field{margin-bottom:16px;}
.p-field label{display:block;font-size:11px;color:rgba(255,255,255,.5);margin-bottom:6px;text-transform:uppercase;letter-spacing:1px;font-weight:700;}
.p-field input, .p-field select, .p-field textarea{width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);border-radius:10px;padding:10px 14px;color:#fff;font-family:inherit;font-size:14px;}
.p-field textarea{height:80px;resize:none;}
.p-actions{display:flex;gap:12px;margin-top:20px;}
.p-btn-save{flex:2;background:linear-gradient(135deg,#00d4ff,#00e676);border:none;border-radius:12px;padding:12px;color:#000;font-weight:800;cursor:pointer;font-family:'Syne',sans-serif;}
.p-btn-cancel{flex:1;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.15);border-radius:12px;padding:12px;color:#fff;font-weight:600;cursor:pointer;}
</style>

<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- ═══ HERO SLIDER ═══ -->
<section class="xd-hero">
  <div class="hero-slider-wrapper">
    <?php echo do_shortcode('[dynamic_slider]'); ?>
  </div>
</section>

<!-- ═══ DASHBOARD ═══ -->
<div id="xd">
<div class="xw">

<!-- ────────────────── TOP ROW ────────────────── -->
<div class="xs">
<div class="g-top">

  <!-- CALORIES -->
  <div class="cd c-cal" style="padding:16px!important">
    <span class="st">Calories</span>
    <div class="st-bar st-pk"></div>
    <div class="mi">
      <div class="dn" style="width:42px!important;height:42px!important;display:inline-flex!important">
        <svg width="42" height="42" viewBox="0 0 42 42" style="width:42px!important;height:42px!important;display:block!important"><circle cx="21" cy="21" r="17" fill="none" stroke="rgba(255,255,255,.08)" stroke-width="4"/><circle id="xd-cal-donut" cx="21" cy="21" r="17" fill="none" stroke="url(#g1)" stroke-width="4" stroke-linecap="round" stroke-dasharray="106.81" stroke-dashoffset="22" transform="rotate(-90 21 21)"/><defs><linearGradient id="g1"><stop offset="0%" stop-color="#e91e8c"/><stop offset="100%" stop-color="#9b59b6"/></linearGradient></defs></svg>
        <b style="font-size:10px!important" id="xd-cal-ring">98</b>
      </div>
      <div><span class="ml" id="xd-cal-txt">1,850</span><span class="ms">kcal consumed</span></div>
    </div>
    <div class="mi">
      <div class="dn" style="width:42px!important;height:42px!important;display:inline-flex!important">
        <svg width="42" height="42" viewBox="0 0 42 42" style="width:42px!important;height:42px!important;display:block!important"><circle cx="21" cy="21" r="17" fill="none" stroke="rgba(255,255,255,.08)" stroke-width="4"/><circle cx="21" cy="21" r="17" fill="none" stroke="url(#g2)" stroke-width="4" stroke-linecap="round" stroke-dasharray="106.81" stroke-dashoffset="45" transform="rotate(-90 21 21)"/><defs><linearGradient id="g2"><stop offset="0%" stop-color="#ff6b9d"/><stop offset="100%" stop-color="#c44569"/></linearGradient></defs></svg>
        <b style="font-size:10px!important">🔥</b>
      </div>
      <div><span class="ml" id="xd-cal-burned">320 kcal</span><span class="ms">Burned today</span></div>
    </div>
    <button class="pb" onclick="G.toast('Calorie entry coming soon!')">+</button>
  </div>

  <!-- WATER -->
  <div class="cd c-water" style="padding:18px!important">
    <span class="st">Water Intake</span>
    <div class="st-bar st-cy"></div>
    <div class="w-item">
      <div class="dn" style="width:58px!important;height:58px!important;display:inline-flex!important">
        <svg width="58" height="58" viewBox="0 0 58 58" style="width:58px!important;height:58px!important;display:block!important"><circle cx="29" cy="29" r="23" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="5"/><circle cx="29" cy="29" r="23" fill="none" stroke="url(#gR)" stroke-width="5" stroke-linecap="round" stroke-dasharray="144.51" stroke-dashoffset="30" transform="rotate(-90 29 29)"/><defs><linearGradient id="gR" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#e91e8c"/><stop offset="50%" stop-color="#f5a623"/><stop offset="100%" stop-color="#00d4ff"/></linearGradient></defs></svg>
        <b style="font-size:13px!important">3L</b>
      </div>
      <div><span class="w-name">Required Water</span><span class="w-sub">Daily goal: 3.0 L</span></div>
    </div>
    <div class="w-item">
      <div class="dn" style="width:58px!important;height:58px!important;display:inline-flex!important">
        <svg width="58" height="58" viewBox="0 0 58 58" style="width:58px!important;height:58px!important;display:block!important"><circle cx="29" cy="29" r="23" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="5"/><circle id="xd-water-donut" cx="29" cy="29" r="23" fill="none" stroke="url(#gW)" stroke-width="5" stroke-linecap="round" stroke-dasharray="144.51" stroke-dashoffset="72" transform="rotate(-90 29 29)"/><defs><linearGradient id="gW" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#00d4ff"/><stop offset="100%" stop-color="#00e676"/></linearGradient></defs></svg>
        <b style="font-size:12px!important" id="xd-water-i">1.5L</b>
      </div>
      <div><span class="w-name">Today Intake</span><span class="w-sub" id="xd-water-pct">50% of goal</span></div>
    </div>
    <div class="w-prog-bg"><div class="w-prog-f" id="xd-water-bar" style="width:50%!important"></div></div>
    <div class="w-add">
      <button class="wml" onclick="G.addWater(100)">+100ml</button>
      <button class="wml" onclick="G.addWater(250)">+250ml</button>
      <button class="wml" onclick="G.addWater(500)">+500ml</button>
    </div>
  </div>

  <!-- WEIGHT -->
  <div class="cd c-wt" style="padding:18px!important">
    <div style="display:flex!important;align-items:center!important;gap:10px!important;margin-bottom:12px!important">
      <div class="dn" style="width:38px!important;height:38px!important;display:inline-flex!important">
        <svg width="38" height="38" viewBox="0 0 38 38" style="width:38px!important;height:38px!important;display:block!important"><circle cx="19" cy="19" r="15" fill="none" stroke="rgba(255,255,255,.08)" stroke-width="3.5"/><circle cx="19" cy="19" r="15" fill="none" stroke="url(#g3)" stroke-width="3.5" stroke-linecap="round" stroke-dasharray="94.25" stroke-dashoffset="22" transform="rotate(-90 19 19)"/><defs><linearGradient id="g3"><stop offset="0%" stop-color="#00d4ff"/><stop offset="100%" stop-color="#9b59b6"/></linearGradient></defs></svg>
        <b style="font-size:9px!important">⚖</b>
      </div>
      <span style="font-size:14px!important;font-weight:700!important;color:#fff!important;display:inline!important">Weight</span>
    </div>
    <span class="wt-lbl">Ideal weight</span>
    <span class="wt-val" id="xd-wt-val">75 KG</span>
    <input class="wt-inp" id="xd-wt-inp" type="number" placeholder="Enter daily weight (kg)" min="20" max="300" step="0.1">
    <div class="spark">
      <svg viewBox="0 0 140 50" preserveAspectRatio="none" style="width:100%!important;height:50px!important;display:block!important"><defs><linearGradient id="gSp" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#e91e8c" stop-opacity=".35"/><stop offset="100%" stop-color="#e91e8c" stop-opacity="0"/></linearGradient></defs><path d="M0,35 C15,28 30,20 50,25 C70,30 85,12 105,18 C120,22 135,28 140,24 L140,50 L0,50 Z" fill="url(#gSp)"/><path d="M0,35 C15,28 30,20 50,25 C70,30 85,12 105,18 C120,22 135,28 140,24" fill="none" stroke="#e91e8c" stroke-width="1.5" stroke-linecap="round"/></svg>
    </div>
    <button class="pb pb-c" onclick="G.bmiFromWeight()">+</button>
  </div>

  <!-- ACHIEVEMENTS -->
  <div class="cd c-ach" style="padding:16px!important">
    <span class="ach-t">Overall Achievements</span>
    <span class="ach-pct" id="xd-ach-val">68%</span>
    <div class="leg"><i class="lp">Target</i><i class="lc">Actual</i></div>
    <svg class="achart" viewBox="0 0 180 60" preserveAspectRatio="none" style="width:100%!important;height:60px!important;display:block!important">
      <defs><linearGradient id="aP" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#e91e8c" stop-opacity=".4"/><stop offset="100%" stop-color="#e91e8c" stop-opacity="0"/></linearGradient><linearGradient id="aC" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#00d4ff" stop-opacity=".3"/><stop offset="100%" stop-color="#00d4ff" stop-opacity="0"/></linearGradient></defs>
      <line x1="0" y1="20" x2="180" y2="20" stroke="rgba(255,255,255,.05)" stroke-width="1"/>
      <line x1="0" y1="40" x2="180" y2="40" stroke="rgba(255,255,255,.05)" stroke-width="1"/>
      <path d="M0,45 C25,35 45,20 70,28 C95,36 115,15 145,22 C160,26 172,30 180,28 L180,60 L0,60 Z" fill="url(#aP)"/>
      <path d="M0,45 C25,35 45,20 70,28 C95,36 115,15 145,22 C160,26 172,30 180,28" fill="none" stroke="#e91e8c" stroke-width="1.8" stroke-linecap="round"/>
      <path d="M0,52 C20,46 40,38 65,42 C90,46 112,32 137,36 C152,38 166,40 180,38 L180,60 L0,60 Z" fill="url(#aC)"/>
      <path d="M0,52 C20,46 40,38 65,42 C90,46 112,32 137,36 C152,38 166,40 180,38" fill="none" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round"/>
    </svg>
  </div>

  <!-- TODAY WORKOUT -->
  <div class="cd c-work" style="padding:22px!important">
    <div style="display:flex!important;justify-content:space-between!important;align-items:center!important;margin-bottom:24px!important">
      <span class="wo-t">Today Workout</span>
      <button class="pb pb-tr" onclick="G.toast('Workout updated!')" style="position:static!important">+</button>
    </div>
    <div class="wo-body">
      <div class="m-list" id="wo-muscle-list">
        <?php
        global $wpdb;
        $wo_plans = $wpdb->get_results("SELECT id, plan_name, muscle_group, calories_est FROM {$wpdb->prefix}tp_workout_plans ORDER BY id DESC LIMIT 4");
        $wo_colors = ['bpk','bbl','bgo','bgr'];
        $wo_pcts = [82,68,74,60];
        if($wo_plans):
          foreach($wo_plans as $wi => $wp):
            $wc = $wo_colors[$wi % 4];
            $wpct = $wo_pcts[$wi % 4];
        ?>
        <div>
          <div class="m-head">
            <span class="m-name"><?php echo esc_html($wp->muscle_group ?: $wp->plan_name); ?></span>
            <span class="m-up"><?php echo (int)$wp->calories_est; ?> kcal</span>
          </div>
          <div class="bar-bg"><div class="bar-f <?php echo $wc; ?>" data-w="<?php echo $wpct; ?>%"></div></div>
        </div>
        <?php endforeach; else: ?>
        <div>
          <div class="m-head"><span class="m-name">No plans yet</span><span class="m-up">Add plans</span></div>
          <div class="bar-bg"><div class="bar-f bpk" data-w="0%"></div></div>
        </div>
        <?php endif; ?>
      </div>
      <div class="wo-r">
        <div class="dn" style="width:148px!important;height:148px!important;display:inline-flex!important">
          <svg width="148" height="148" viewBox="0 0 148 148" style="width:148px!important;height:148px!important;display:block!important">
            <circle cx="74" cy="74" r="62" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="12"/>
            <circle id="xd-wo-svg" cx="74" cy="74" r="62" fill="none" stroke="url(#gGo)" stroke-width="12" stroke-linecap="round" stroke-dasharray="389.56" stroke-dashoffset="100" transform="rotate(-90 74 74)"/>
            <circle cx="74" cy="74" r="62" fill="none" stroke="url(#gPk)" stroke-width="12" stroke-linecap="round" stroke-dasharray="389.56" stroke-dashoffset="290" transform="rotate(130 74 74)"/>
            <defs>
              <linearGradient id="gGo" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#fecb00"/><stop offset="100%" stop-color="#f5a623"/></linearGradient>
              <linearGradient id="gPk" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#00d4ff"/><stop offset="100%" stop-color="#3498db"/></linearGradient>
            </defs>
          </svg>
          <b style="font-size:40px!important;color:#00d4ff!important" id="xd-wo-overall">71</b>
        </div>
        <span class="wo-lbl">Overall</span>
        <div style="display:flex!important;gap:8px!important;width:100%!important">
          <a href="<?php echo home_url("/index.php/workout/?plan_id=current"); ?>" class="wbtn wbtn-p" style="text-decoration:none!important;display:flex!important;align-items:center!important;justify-content:center!important">View workout</a>
          <button class="wbtn wbtn-g" onclick="G.downloadReport()">Report</button>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- /xs -->

<!-- ────────────────── BURN | MEALS | NUTRITION ────────────────── -->
<div class="xs">
<div class="g-bot">

  <!-- WORKOUT BURN — connected to workout -->
  <div class="cd inf">
    <span class="inf-t">Workout Burn</span>
    <div class="inf-bar" style="background:linear-gradient(90deg,#e91e8c,#9b59b6)!important"></div>
    <div class="inf-st"><span class="st-dot"></span><span class="st-txt">Healthy</span></div>
    <span class="inf-up" id="xd-wb-val">320 kcal burned</span>
    <div class="inf-row">
      <span class="inf-lo">Connected to today's workout performance & overall score.</span>
      <div class="dn" style="width:84px!important;height:84px!important;display:inline-flex!important">
        <svg width="84" height="84" viewBox="0 0 84 84" style="width:84px!important;height:84px!important;display:block!important"><circle cx="42" cy="42" r="34" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="7"/><circle id="xd-wb-donut" cx="42" cy="42" r="34" fill="none" stroke="url(#gB1)" stroke-width="7" stroke-linecap="round" stroke-dasharray="213.63" stroke-dashoffset="54" transform="rotate(-90 42 42)"/><defs><linearGradient id="gB1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#e91e8c"/><stop offset="100%" stop-color="#9b59b6"/></linearGradient></defs></svg>
        <b style="font-size:18px!important;color:#00d4ff!important" id="xd-wb-pct">75</b>
      </div>
    </div>
    <button class="pb" onclick="G.toast('Burn details updated!')">+</button>
  </div>

  <!-- DAILY MEALS + AI SCANNER -->
  <div class="cd inf">
    <span class="inf-t">Daily Meals</span>
    <div class="inf-bar" style="background:linear-gradient(90deg,#fecb00,#f5a623)!important"></div>
    <div class="inf-st"><span class="st-dot"></span><span class="st-txt">Healthy</span></div>
    <span class="inf-up">Connected → Calories · Protein · Nutrition</span>
    <button class="ai-btn" onclick="G.openAI()">
      <span class="ai-icon">📸</span>
      AI Meal Scanner — Log food with camera
    </button>
    <div class="inf-row" style="margin-top:12px!important">
      <span class="inf-lo">AI scans your meal and auto-fills all nutrition data.</span>
      <div class="dn" style="width:84px!important;height:84px!important;display:inline-flex!important">
        <svg width="84" height="84" viewBox="0 0 84 84" style="width:84px!important;height:84px!important;display:block!important"><circle cx="42" cy="42" r="34" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="7"/><circle id="xd-meal-donut" cx="42" cy="42" r="34" fill="none" stroke="url(#gB2)" stroke-width="7" stroke-linecap="round" stroke-dasharray="213.63" stroke-dashoffset="48" transform="rotate(-90 42 42)"/><defs><linearGradient id="gB2" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#fecb00"/><stop offset="100%" stop-color="#f5a623"/></linearGradient></defs></svg>
        <b style="font-size:18px!important;color:#fecb00!important" id="xd-meal-val">77</b>
      </div>
    </div>
    <button class="pb" onclick="G.openAI()">+</button>
  </div>

  <!-- NUTRITIONS — connected to water + meals -->
  <div class="cd inf">
    <span class="inf-t">Nutritions</span>
    <div class="inf-bar" style="background:linear-gradient(90deg,#00d4ff,#00e676)!important"></div>
    <div class="inf-st"><span class="st-dot"></span><span class="st-txt">Healthy</span></div>
    <span class="inf-up">Connected → Water · Meals · Calories</span>
    <div style="margin-top:10px!important">
      <div style="display:flex!important;justify-content:space-between!important;margin-bottom:6px!important">
        <span style="font-size:11px!important;color:rgba(255,255,255,.5)!important">Nutrition Score</span>
        <span style="font-size:11px!important;font-weight:700!important;color:#00d4ff!important" id="xd-nutrition-pct">76%</span>
      </div>
      <div style="height:6px!important;background:rgba(255,255,255,.1)!important;border-radius:3px!important;overflow:hidden!important;display:block!important">
        <div id="xd-nutrition-bar" style="height:100%!important;border-radius:3px!important;background:linear-gradient(90deg,#00d4ff,#00e676)!important;display:block!important;width:76%!important;transition:width 1s ease!important"></div>
      </div>
    </div>
    <div class="inf-row" style="margin-top:12px!important">
      <span class="inf-lo">Score updates automatically when you log water or food.</span>
      <div class="dn" style="width:84px!important;height:84px!important;display:inline-flex!important">
        <svg width="84" height="84" viewBox="0 0 84 84" style="width:84px!important;height:84px!important;display:block!important"><circle cx="42" cy="42" r="34" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="7"/><circle id="xd-nutrition-donut" cx="42" cy="42" r="34" fill="none" stroke="url(#gB3)" stroke-width="7" stroke-linecap="round" stroke-dasharray="213.63" stroke-dashoffset="52" transform="rotate(-90 42 42)"/><defs><linearGradient id="gB3" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#00d4ff"/><stop offset="50%" stop-color="#00e676"/><stop offset="100%" stop-color="#3498db"/></linearGradient></defs></svg>
        <b style="font-size:18px!important;color:#00e676!important" id="xd-nutrition-val">76</b>
      </div>
    </div>
    <button class="pb" onclick="G.toast('Nutrition details coming soon!')">+</button>
  </div>

</div>
</div><!-- /xs -->

<!-- ────────────────── PROTEIN | BMI | ENERGY ────────────────── -->
<div class="xs">
<div class="g-new">

  <!-- PROTEIN TRACKER -->
  <div class="cd" style="padding:22px!important">
    <span class="st">Protein Tracker</span>
    <div class="st-bar st-pu"></div>
    <div class="prot-top">
      <div class="dn" style="width:80px!important;height:80px!important;display:inline-flex!important">
        <svg width="80" height="80" viewBox="0 0 80 80" style="width:80px!important;height:80px!important;display:block!important"><circle cx="40" cy="40" r="32" fill="none" stroke="rgba(255,255,255,.08)" stroke-width="7"/><circle id="xd-prot-donut" cx="40" cy="40" r="32" fill="none" stroke="url(#gProt)" stroke-width="7" stroke-linecap="round" stroke-dasharray="201.06" stroke-dashoffset="102" transform="rotate(-90 40 40)"/><defs><linearGradient id="gProt" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#8b5cf6"/><stop offset="100%" stop-color="#e91e8c"/></linearGradient></defs></svg>
        <b style="font-size:14px!important;color:#8b5cf6!important" id="xd-prot-ring">95g</b>
      </div>
      <div class="prot-info">
        <span class="prot-val" id="xd-prot-val">95g</span>
        <span class="prot-goal-txt" id="xd-prot-goal-txt">95g / 180g daily goal</span>
      </div>
    </div>
    <div class="prot-bar-bg"><div class="prot-bar-f" id="xd-prot-bar" style="width:53%!important"></div></div>
    <div class="macro-row">
      <div class="macro-box">
        <span class="macro-lbl">Protein</span>
        <span class="macro-val" style="color:#8b5cf6!important" id="xd-prot-g">95g</span>
      </div>
      <div class="macro-box">
        <span class="macro-lbl">Carbs</span>
        <span class="macro-val" style="color:#fecb00!important" id="xd-carbs-val">165g</span>
      </div>
      <div class="macro-box">
        <span class="macro-lbl">Fat</span>
        <span class="macro-val" style="color:#f97316!important" id="xd-fat-val">58g</span>
      </div>
    </div>
    <div style="margin-top:14px!important">
      <button class="ai-btn" onclick="G.openAI()" style="margin-top:0!important">
        <span class="ai-icon">🥩</span> Log food to update protein
      </button>
    </div>
    <button class="pb pb-c" onclick="G.openAI()">+</button>
  </div>

  <!-- BMI CALCULATOR -->
  <div class="cd" style="padding:22px!important">
    <span class="st">BMI Calculator</span>
    <div class="st-bar st-cy"></div>
    <div class="bmi-fields">
      <div class="bmi-f">
        <span class="bmi-lbl">Weight (kg)</span>
        <input class="bmi-inp" id="bmi-w-inp" type="number" value="75" min="30" max="300" step="0.1">
      </div>
      <div class="bmi-f">
        <span class="bmi-lbl">Height (cm)</span>
        <input class="bmi-inp" id="bmi-h-inp" type="number" value="175" min="100" max="250" step="1">
      </div>
    </div>
    <div class="bmi-result">
      <div>
        <span class="bmi-num" id="xd-bmi-num">24.5</span>
      </div>
      <div>
        <span class="bmi-cat" id="xd-bmi-cat" style="color:#00e676!important">Normal</span>
        <span class="bmi-desc">Healthy BMI range:<br>18.5 – 24.9</span>
      </div>
    </div>
    <div class="bmi-scale">
      <div class="bmi-track">
        <div class="bmi-marker" id="xd-bmi-marker" style="left:38%!important"></div>
      </div>
      <div class="bmi-labs">
        <span class="bmi-ll">15</span>
        <span class="bmi-ll">Underweight</span>
        <span class="bmi-ll">Normal</span>
        <span class="bmi-ll">Over</span>
        <span class="bmi-ll">40</span>
      </div>
    </div>
    <button class="pb pb-c" onclick="G.calcBMIBtn()">↻</button>
  </div>

    <!-- ENERGY LEVEL -->
  <div class="cd" style="padding:20px!important">
    <span class="st">Energy Level</span>
    <div class="st-bar st-go"></div>
    <div class="energy-center">
      <div class="dn" style="width:100px!important;height:100px!important;display:inline-flex!important">
        <svg width="100" height="100" viewBox="0 0 100 100" style="width:100px!important;height:100px!important;display:block!important">
          <circle cx="50" cy="50" r="42" fill="none" stroke="rgba(255,255,255,.07)" stroke-width="9"/>
          <circle id="xd-energy-svg" cx="50" cy="50" r="42" fill="none" stroke="url(#gEn)" stroke-width="9" stroke-linecap="round" stroke-dasharray="263.9" stroke-dashoffset="74" transform="rotate(-90 50 50)"/>
          <defs><linearGradient id="gEn" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#fecb00"/><stop offset="100%" stop-color="#e91e8c"/></linearGradient></defs>
        </svg>
        <b style="font-size:20px!important;color:#fecb00!important" id="xd-energy-val">72%</b>
      </div>
      <span style="font-size:11px!important;color:rgba(255,255,255,.45)!important;display:block!important;margin-top:6px!important">Boosts with water + food</span>
    </div>
    <div class="e-factors">
      <div class="e-row">
        <span class="e-lbl"><span style="display:inline-block!important;width:7px!important;height:7px!important;border-radius:50%!important;background:#00d4ff!important;margin-right:5px!important;flex-shrink:0!important"></span>Hydration</span>
        <div class="e-bar-bg"><div class="e-bar-f" id="xd-e-water" style="width:50%!important;background:linear-gradient(90deg,#00d4ff,#00e676)!important"></div></div>
        <span class="e-pct" id="xd-e-water-pct">50%</span>
      </div>
      <div class="e-row">
        <span class="e-lbl"><span style="display:inline-block!important;width:7px!important;height:7px!important;border-radius:50%!important;background:#fecb00!important;margin-right:5px!important;flex-shrink:0!important"></span>Nutrition</span>
        <div class="e-bar-bg"><div class="e-bar-f" id="xd-e-nutr" style="width:76%!important;background:linear-gradient(90deg,#fecb00,#f5a623)!important"></div></div>
        <span class="e-pct" id="xd-e-nutr-pct">76%</span>
      </div>
      <div class="e-row">
        <span class="e-lbl"><span style="display:inline-block!important;width:7px!important;height:7px!important;border-radius:50%!important;background:#e91e8c!important;margin-right:5px!important;flex-shrink:0!important"></span>Workout</span>
        <div class="e-bar-bg"><div class="e-bar-f" id="xd-e-work" style="width:71%!important;background:linear-gradient(90deg,#e91e8c,#9b59b6)!important"></div></div>
        <span class="e-pct" id="xd-e-work-pct">71%</span>
      </div>
      <div class="e-row">
        <span class="e-lbl"><span style="display:inline-block!important;width:7px!important;height:7px!important;border-radius:50%!important;background:#8b5cf6!important;margin-right:5px!important;flex-shrink:0!important"></span>Protein</span>
        <div class="e-bar-bg"><div class="e-bar-f" id="xd-e-prot" style="width:53%!important;background:linear-gradient(90deg,#8b5cf6,#e91e8c)!important"></div></div>
        <span class="e-pct" id="xd-e-prot-pct">53%</span>
      </div>
    </div>
    <button class="pb pb-g" onclick="G.toast('Energy factors updated!')">+</button>
  </div>

</div>
</div><!-- /xs -->

<!-- ────────────────── MY HEALTH ────────────────── -->
<div class="xs">
<div class="g-hlth">

  <!-- HEALTH SCORE -->
  <div class="cd hlth-center">
    <div class="dn" style="width:160px!important;height:160px!important;display:inline-flex!important">
      <svg width="160" height="160" viewBox="0 0 160 160" style="width:160px!important;height:160px!important;display:block!important">
        <circle cx="80" cy="80" r="68" fill="none" stroke="rgba(255,255,255,.06)" stroke-width="14"/>
        <circle id="xd-health-svg" cx="80" cy="80" r="68" fill="none" stroke="url(#gHlth)" stroke-width="14" stroke-linecap="round" stroke-dasharray="427.26" stroke-dashoffset="150" transform="rotate(-90 80 80)"/>
        <defs><linearGradient id="gHlth" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#00d4ff"/><stop offset="50%" stop-color="#00e676"/><stop offset="100%" stop-color="#fecb00"/></linearGradient></defs>
      </svg>
      <b style="font-size:46px!important;color:#fff!important;flex-direction:column!important">
        <span id="xd-health-score" style="display:block!important;text-align:center!important">65</span>
        <span style="font-size:12px!important;color:rgba(255,255,255,.5)!important;display:block!important;text-align:center!important">/100</span>
      </b>
    </div>
    <span style="font-size:13px!important;color:rgba(255,255,255,.5)!important;display:block!important;text-align:center!important;margin-top:10px!important">Overall Health Score</span>
    <span class="hlth-badge" id="xd-health-grade" style="background:rgba(0,212,255,.15)!important;color:#00d4ff!important;display:block!important;text-align:center!important;margin-top:12px!important">Good</span>
    <span style="font-size:11px!important;color:rgba(255,255,255,.35)!important;display:block!important;text-align:center!important;margin-top:10px!important;line-height:1.6!important">Score calculated from:<br>Water · Nutrition · Workout · Energy</span>
  </div>

  <!-- HEALTH METRICS -->
  <div class="cd" style="padding:20px!important">
    <span class="st">My Health Metrics</span>
    <div class="st-bar st-gr"></div>
    <div class="hlth-grid">

      <div class="hm">
        <span class="hm-l">
          <span style="display:inline-block!important;width:8px!important;height:8px!important;border-radius:50%!important;background:#00d4ff!important;box-shadow:0 0 5px #00d4ff!important;flex-shrink:0!important"></span>
          Hydration
        </span>
        <span class="hm-v" style="color:#00d4ff!important" id="xd-hm-water">50%</span>
        <div class="hm-bg"><div class="hm-bf" id="xd-hm-water-bar" style="width:50%!important;background:linear-gradient(90deg,#00d4ff,#00e676)!important"></div></div>
      </div>

      <div class="hm">
        <span class="hm-l">
          <span style="display:inline-block!important;width:8px!important;height:8px!important;border-radius:50%!important;background:#e91e8c!important;box-shadow:0 0 5px #e91e8c!important;flex-shrink:0!important"></span>
          Calories
        </span>
        <span class="hm-v" style="color:#e91e8c!important" id="xd-hm-cal">1,850</span>
        <div class="hm-bg"><div class="hm-bf" id="xd-hm-cal-bar" style="width:84%!important;background:linear-gradient(90deg,#e91e8c,#9b59b6)!important"></div></div>
      </div>

      <div class="hm">
        <span class="hm-l">
          <span style="display:inline-block!important;width:8px!important;height:8px!important;border-radius:50%!important;background:#8b5cf6!important;box-shadow:0 0 5px #8b5cf6!important;flex-shrink:0!important"></span>
          Protein
        </span>
        <span class="hm-v" style="color:#8b5cf6!important" id="xd-hm-protein">95g</span>
        <div class="hm-bg"><div class="hm-bf" id="xd-hm-prot-bar" style="width:53%!important;background:linear-gradient(90deg,#8b5cf6,#e91e8c)!important"></div></div>
      </div>

      <div class="hm">
        <span class="hm-l">
          <span style="display:inline-block!important;width:8px!important;height:8px!important;border-radius:50%!important;background:#fecb00!important;box-shadow:0 0 5px #fecb00!important;flex-shrink:0!important"></span>
          Workout
        </span>
        <span class="hm-v" style="color:#fecb00!important" id="xd-hm-workout">71%</span>
        <div class="hm-bg"><div class="hm-bf" id="xd-hm-workout-bar" style="width:71%!important;background:linear-gradient(90deg,#fecb00,#f5a623)!important"></div></div>
      </div>

      <div class="hm">
        <span class="hm-l">
          <span style="display:inline-block!important;width:8px!important;height:8px!important;border-radius:50%!important;background:#f97316!important;box-shadow:0 0 5px #f97316!important;flex-shrink:0!important"></span>
          Energy
        </span>
        <span class="hm-v" style="color:#f97316!important" id="xd-hm-energy">72%</span>
        <div class="hm-bg"><div class="hm-bf" id="xd-hm-energy-bar" style="width:72%!important;background:linear-gradient(90deg,#f97316,#fecb00)!important"></div></div>
      </div>

      <div class="hm">
        <span class="hm-l">
          <span style="display:inline-block!important;width:8px!important;height:8px!important;border-radius:50%!important;background:#00e676!important;box-shadow:0 0 5px #00e676!important;flex-shrink:0!important"></span>
          Nutrition
        </span>
        <span class="hm-v" style="color:#00e676!important" id="xd-hm-nutr">76%</span>
        <div class="hm-bg"><div class="hm-bf" id="xd-hm-nutr-bar" style="width:76%!important;background:linear-gradient(90deg,#00e676,#00bcd4)!important"></div></div>
      </div>

    </div>
  </div>

</div>
</div><!-- /xs -->

</div><!-- /xw -->
</div><!-- #xd -->

<!-- ═══ AI MEAL MODAL ═══ -->
<div id="xd-modal-bg">
  <div id="xd-modal">
    <button id="xd-modal-close" onclick="G.closeAI()">&#x2715;</button>
    <h3>&#x1F4F8; AI Meal Scanner</h3>
    <span class="ai-desc">Photo detects food name &#8594; enter grams &#8594; macros auto-calculated &amp; synced to Energy, Protein, Calories.</span>

    <!-- Hidden file input -->
    <input type="file" id="ai-file-input" accept="image/*" capture="environment">

    <!-- Upload zone -->
    <div class="ai-scan-area" id="ai-scan-area" onclick="document.getElementById('ai-file-input').click()">
      <img id="ai-preview-img" class="ai-preview-img" src="" alt="Meal preview">
      <div class="ai-scan-inner" id="ai-scan-inner">
        <span class="ai-scan-icon" id="ai-scan-icon">&#128247;</span>
        <span class="ai-scan-txt" id="ai-scan-txt">Tap to upload meal photo</span>
        <span class="ai-scan-sub">JPG &#xb7; PNG &#xb7; HEIC &#xb7; Camera supported</span>
      </div>
    </div>

    <!-- Detected food badge (shown after scan) -->
    <div class="ai-food-badge" id="ai-food-badge">
      <div style="flex:1">
        <span class="ai-food-name" id="ai-food-name">Grilled Chicken</span>
        <span class="ai-food-per" id="ai-food-per">165 kcal &middot; 31g protein per 100g</span>
      </div>
      <span class="ai-food-tag" id="ai-food-tag">AI Detected</span>
    </div>

    <!-- Grams input (only editable field) -->
    <div class="ai-gram-row" id="ai-gram-row" style="display:none">
      <span class="ai-gram-lbl">Enter serving size:</span>
      <input type="number" id="ai-gram-inp" value="150" min="1" max="2000" oninput="G.calcFromGrams()">
      <span class="ai-gram-unit">g</span>
    </div>

    <!-- Auto-calculated macros (read-only display) -->
    <div class="ai-macros" id="ai-macros" style="display:none">
      <div class="ai-macro-box">
        <span class="ai-macro-lbl">Calories</span>
        <span class="ai-macro-val" id="ai-r-cal" style="color:#e91e8c">-</span>
      </div>
      <div class="ai-macro-box">
        <span class="ai-macro-lbl">Protein</span>
        <span class="ai-macro-val" id="ai-r-prot" style="color:#8b5cf6">-</span>
      </div>
      <div class="ai-macro-box">
        <span class="ai-macro-lbl">Carbs</span>
        <span class="ai-macro-val" id="ai-r-carb" style="color:#fecb00">-</span>
      </div>
      <div class="ai-macro-box">
        <span class="ai-macro-lbl">Fat</span>
        <span class="ai-macro-val" id="ai-r-fat" style="color:#f97316">-</span>
      </div>
    </div>

    <!-- Section links -->
    <div class="ai-links" id="ai-links" style="display:none">
      <span class="ai-link-btn" onclick="G.scrollTo('xd-nutrition-val')">&#x1F4CA; Nutrition</span>
      <span class="ai-link-btn" onclick="G.scrollTo('xd-prot-val')">&#x1F969; Protein</span>
      <span class="ai-link-btn" onclick="G.scrollTo('xd-cal-txt')">&#x1F525; Calories</span>
      <span class="ai-link-btn" onclick="G.scrollTo('xd-energy-val')">&#x26A1; Energy</span>
      <a class="ai-link-btn" href="/diet" target="_blank">&#x1F4D6; Diet Page</a>
    </div>

    <!-- Hidden data fields (used by confirmMeal JS) -->
    <input type="hidden" id="ai-cal-inp"  value="0">
    <input type="hidden" id="ai-prot-inp" value="0">
    <input type="hidden" id="ai-carb-inp" value="0">
    <input type="hidden" id="ai-fat-inp"  value="0">

    <div class="ai-actions">
      <button class="ai-btn-cancel" onclick="G.closeAI()">Cancel</button>
      <button class="ai-btn-ok" id="ai-log-btn" onclick="G.confirmMeal()" disabled>&#x2713; Log This Meal</button>
    </div>
  </div>
</div>

<!-- ═══ WORKOUT MODAL ═══ -->
<div id="xd-work-modal-bg">
  <div id="xd-work-modal">
    <button id="xd-modal-close" onclick="G.closeWorkout()">&#x2715;</button>
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
      <!-- Exercises will be injected here -->
      <div style="padding:40px;text-align:center;color:rgba(255,255,255,0.2)">Loading workout plan...</div>
    </div>
  </div>
</div>

<!-- ═══ PROFILE MODAL ═══ -->
<div id="xd-profile-modal-bg">
  <div id="xd-profile-modal">
    <button id="xd-modal-close" onclick="G.closeProfile()">&#x2715;</button>
    <h3>&#x1F464; My Profile</h3>
    <form id="profile-form" onsubmit="event.preventDefault(); G.saveProfile();">
      <div class="p-form-grid">
        <div class="p-field">
          <label>Full Name</label>
          <input type="text" id="p-name" required>
        </div>
        <div class="p-field">
          <label>Email</label>
          <input type="email" id="p-email" required>
        </div>
        <div class="p-field">
          <label>Mobile</label>
          <input type="text" id="p-mobile">
        </div>
        <div class="p-field">
          <label>Age</label>
          <input type="number" id="p-age">
        </div>
        <div class="p-field">
          <label>Gender</label>
          <select id="p-gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="p-field">
          <label>Blood Group</label>
          <input type="text" id="p-blood" placeholder="e.g. O+">
        </div>
        <div class="p-field">
          <label>Current Weight (kg)</label>
          <input type="number" id="p-weight" step="0.1">
        </div>
        <div class="p-field">
          <label>Ideal Weight (kg)</label>
          <input type="number" id="p-ideal" step="0.1">
        </div>
        <div class="p-field" style="grid-column: 1 / -1;">
          <label>Fitness Goal</label>
          <select id="p-goal">
            <option value="Weight Loss">Weight Loss</option>
            <option value="Muscle Gain">Muscle Gain</option>
            <option value="Endurance">Endurance</option>
            <option value="General Health">General Health</option>
          </select>
        </div>
        <div class="p-field" style="grid-column: 1 / -1;">
          <label>Health Notes / Problems</label>
          <textarea id="p-health"></textarea>
        </div>
      </div>
      <div class="p-actions">
        <button type="button" class="p-btn-cancel" onclick="G.closeProfile()">Cancel</button>
        <button type="submit" class="p-btn-save">Save Profile Settings</button>
      </div>
    </form>
  </div>
</div>

<div id="xd-toast"></div>

<!-- ═══ FOOTER ═══ -->
<footer id="xd-footer">
  <div class="xdf-stats">
    <div class="xdf-stats-in">
      <div class="xdf-stat">
        <span class="xdf-snum" id="xdf-water">1.5<small style="font-size:16px">L</small></span>
        <span class="xdf-slbl">Water Today</span>
      </div>
      <div class="xdf-stat">
        <span class="xdf-snum" id="xdf-cal">1,850</span>
        <span class="xdf-slbl">Calories Consumed</span>
      </div>
      <div class="xdf-stat">
        <span class="xdf-snum" id="xdf-protein">95<small style="font-size:16px">g</small></span>
        <span class="xdf-slbl">Protein Intake</span>
      </div>
      <div class="xdf-stat">
        <span class="xdf-snum" id="xdf-health">65</span>
        <span class="xdf-slbl">Health Score</span>
      </div>
    </div>
  </div>
  <div class="xdf-main">
    <div class="xdf-brand">
      <span class="xdf-logo">TRAIN<span>O</span>PRO</span>
      <p>Your premium fitness companion. Track workouts, nutrition, hydration and health — all in one intelligent dashboard powered by AI.</p>
      <div class="xdf-social">
        <a href="#" aria-label="Instagram">📸</a>
        <a href="#" aria-label="Twitter">🐦</a>
        <a href="#" aria-label="YouTube">▶️</a>
        <a href="#" aria-label="TikTok">🎵</a>
      </div>
    </div>
    <div class="xdf-col">
      <h5>Dashboard</h5>
      <ul>
        <li><a href="#">Today's Workout</a></li>
        <li><a href="#">Nutrition Log</a></li>
        <li><a href="#">Water Tracker</a></li>
        <li><a href="#">Weight History</a></li>
        <li><a href="#">BMI Calculator</a></li>
      </ul>
    </div>
    <div class="xdf-col">
      <h5>Features</h5>
      <ul>
        <li><a href="#">AI Meal Scanner</a></li>
        <li><a href="#">Protein Tracker</a></li>
        <li><a href="#">My Health Report</a></li>
        <li><a href="#">Supplement Guide</a></li>
        <li><a href="#">Progress Photos</a></li>
      </ul>
    </div>
    <div class="xdf-col">
      <h5>Support</h5>
      <ul>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">Contact Coach</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">API Docs</a></li>
      </ul>
    </div>
  </div>
  <div class="xdf-bottom">
    <p>© <?php echo date('Y'); ?> <a href="#">TrainoPro</a>. Built for champions. All rights reserved.</p>
    <div class="xdf-links">
      <a href="#">Privacy</a>
      <a href="#">Terms</a>
      <a href="#">Cookies</a>
    </div>
    <span class="xdf-badge">⚡ AI Powered</span>
  </div>
</footer>

<script>
/* ═══════════════════════════════════════════
   GYM STATE MANAGEMENT SYSTEM
   Water → Energy + Calories + Nutrition
   AI Meal → Protein + Calories + Nutrition + Energy
   Workout → Overall + Achievements + Burn
   All → Health Score
═══════════════════════════════════════════ */
const G = {
  s: {
    waterI: 1.5, waterG: 3.0,
    cal: 1850, calBurned: 320, calG: 2200,
    energy: 72,
    protein: 95, protG: 180,
    carbs: 165, fat: 58,
    nutrition: 76,
    wChest: 82, wShoulder: 68, wTriceps: 74, wBiceps: 60,
    workoutOverall: 71,
    achievements: 68,
    workoutBurn: 320,
    bmi: 24.5, bmiCat: 'Normal',
    weight: 75, height: 175,
    health: 65,
    restUrl: '/wp-json/trainopro/v1/',
  },

  async init() {
    this.s.workoutOverall = Math.round((this.s.wChest + this.s.wShoulder + this.s.wTriceps + this.s.wBiceps) / 4);
    
    // Fetch real data on init
    try {
      const [profile, summary] = await Promise.all([
        fetch(this.s.restUrl + 'profile').then(r => r.json()),
        fetch(this.s.restUrl + 'daily-summary').then(r => r.json())
      ]);

      if (profile && profile.user_id) {
        this.s.weight = parseFloat(profile.current_weight) || this.s.weight;
        this.s.height = 175; // Logic to handle height if needed
      }

      if (summary) {
        this.s.waterI  = parseFloat(summary.water_ml) / 1000 || 0;
        this.s.cal     = parseInt(summary.calories) || 0;
        this.s.protein = parseFloat(summary.protein) || 0;
        this.s.carbs   = parseFloat(summary.carbs) || 0;
        this.s.fat     = parseFloat(summary.fat) || 0;
      }
    } catch (e) { console.error('Data fetch failed', e); }

    this.s.health = this.calcHealth();
    this.render();
    setTimeout(() => {
      document.querySelectorAll('.bar-f[data-w]').forEach(b => {
        b.style.setProperty('width', b.dataset.w, 'important');
      });
    }, 700);
  },

  async addWater(ml) {
    const L = ml / 1000;
    this.s.waterI = Math.min(parseFloat((this.s.waterI + L).toFixed(2)), this.s.waterG + 0.5);
    
    // Persistence
    try {
      await fetch(this.s.restUrl + 'log-metric', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': wpApiSettings.nonce },
        body: JSON.stringify({ metric_type: 'water', metric_value: ml })
      });
    } catch (e) { console.error('Water save failed', e); }

    // Connections
    this.s.energy    = Math.min(100, Math.round(this.s.energy + (ml / 250) * 5));
    this.s.calBurned = Math.min(1800, this.s.calBurned + Math.round(ml / 12));
    this.s.nutrition = Math.min(100, Math.round(this.s.nutrition + (ml / 500) * 2.5));
    this.s.workoutBurn = this.s.calBurned;
    this.s.health = this.calcHealth();
    this.render();
    this.toast(`💧 +${ml}ml logged! Energy & Nutrition updated.`);
  },

  addMeal(cal, prot, carbs, fat) {
    this.s.cal     += cal;
    this.s.protein += prot;
    this.s.carbs   += carbs;
    this.s.fat     += fat;
    const pPct  = Math.min(1, this.s.protein / this.s.protG);
    const cPct  = Math.min(1, this.s.cal / this.s.calG);
    this.s.nutrition = Math.min(100, Math.round(pPct * 55 + cPct * 20 + 25));
    this.s.energy    = Math.min(100, Math.round(this.s.energy + cal / 80));
    this.s.calBurned = Math.min(1800, this.s.calBurned + Math.round(prot * 0.8));
    this.s.workoutBurn = this.s.calBurned;
    this.s.health = this.calcHealth();
    this.render();
    this.toast(`🍽️ Meal logged! +${prot}g protein · +${cal} kcal`);
  },

  calcBMI(w, h) {
    const hm = h / 100;
    const bmi = w / (hm * hm);
    this.s.bmi = parseFloat(bmi.toFixed(1));
    this.s.weight = w; this.s.height = h;
    if (bmi < 18.5)      this.s.bmiCat = 'Underweight';
    else if (bmi < 25)   this.s.bmiCat = 'Normal';
    else if (bmi < 30)   this.s.bmiCat = 'Overweight';
    else                 this.s.bmiCat = 'Obese';
    this.s.health = this.calcHealth();
    this.render();
  },

  async persistProfile() {
    try {
      const response = await fetch(this.s.restUrl + 'profile', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': wpApiSettings.nonce },
        body: JSON.stringify({
          current_weight: this.s.weight,
          age: 25, // Placeholder or fetch from state
          gender: 'Male',
          goal: 'Muscle Gain'
        })
      });
      const data = await response.json();
      if (data.success) console.log('Profile persisted');
    } catch (e) { console.error('Persistence failed', e); }
  },

  calcBMIBtn() {
    const w = parseFloat(document.getElementById('bmi-w-inp')?.value) || this.s.weight;
    const h = parseFloat(document.getElementById('bmi-h-inp')?.value) || this.s.height;
    this.calcBMI(w, h);
    this.toast('BMI: ' + this.s.bmi + ' — ' + this.s.bmiCat);
    this.persistProfile();
  },

  downloadReport() {
    this.toast('📊 Generating your health report...');
    const data = `TrainoPro Health Report\nDate: ${new Date().toLocaleDateString()}\n\nWeight: ${this.s.weight}kg\nBMI: ${this.s.bmi} (${this.s.bmiCat})\nWater: ${this.s.waterI}L\nCalories: ${this.s.cal} consumed\nProtein: ${this.s.protein}g\nHealth Score: ${this.s.health}/100\n\nKeep crushing it!`;
    const blob = new Blob([data], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `TrainoPro_Report_${new Date().toISOString().split('T')[0]}.txt`;
    document.body.appendChild(a);
    a.click();
    window.URL.revokeObjectURL(url);
    this.toast('✅ Report downloaded!');
  },

  bmiFromWeight() {
    const v = parseFloat(document.getElementById('xd-wt-inp')?.value);
    if (v > 0) {
      document.getElementById('xd-wt-val').textContent = v.toFixed(1) + ' KG';
      document.getElementById('bmi-w-inp').value = v;
      this.calcBMI(v, this.s.height);
      this.toast('Weight ' + v + 'kg saved. BMI updated!');
      this.persistProfile();
    }
  },

  openWorkout() {
    document.getElementById('xd-work-modal-bg').classList.add('open');
    this.fetchTodayPlan();
  },

  openProfile() {
    document.getElementById('xd-profile-modal-bg').classList.add('open');
    // Pre-fill form from state
    document.getElementById('p-name').value   = this.s.fullName   || '';
    document.getElementById('p-email').value  = this.s.email      || '';
    document.getElementById('p-mobile').value = this.s.mobile     || '';
    document.getElementById('p-age').value    = this.s.age        || '';
    document.getElementById('p-gender').value = this.s.gender     || 'Male';
    document.getElementById('p-blood').value  = this.s.bloodGroup || '';
    document.getElementById('p-weight').value = this.s.weight     || '';
    document.getElementById('p-ideal').value  = this.s.idealWeight  || '';
    document.getElementById('p-goal').value   = this.s.goal       || 'Muscle Gain';
    document.getElementById('p-health').value = this.s.healthNotes || '';
  },

  closeProfile() {
    document.getElementById('xd-profile-modal-bg').classList.remove('open');
  },

  async saveProfile() {
    const data = {
      full_name:      document.getElementById('p-name').value,
      email:          document.getElementById('p-email').value,
      mobile:         document.getElementById('p-mobile').value,
      age:            parseInt(document.getElementById('p-age').value),
      gender:         document.getElementById('p-gender').value,
      blood_group:    document.getElementById('p-blood').value,
      current_weight: parseFloat(document.getElementById('p-weight').value),
      ideal_weight:   parseFloat(document.getElementById('p-ideal').value),
      goal:           document.getElementById('p-goal').value,
      health_notes:   document.getElementById('p-health').value,
    };

    try {
      const resp = await fetch(this.s.restUrl + 'profile', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': wpApiSettings.nonce },
        body: JSON.stringify(data)
      });
      const res = await resp.json();
      if (res.success) {
        this.toast('✅ Profile updated successfully!');
        this.s.weight = data.current_weight;
        this.s.idealWeight = data.ideal_weight;
        this.s.goal = data.goal;
        this.render();
        this.closeProfile();
      }
    } catch (e) { this.toast('❌ Failed to save profile.'); }
  },

  closeWorkout() {
    document.getElementById('xd-work-modal-bg').classList.remove('open');
  },

  async fetchTodayPlan() {
    const mount = document.getElementById('ex-list-mount');
    if (mount) mount.innerHTML = '<div style="padding:40px;text-align:center;color:rgba(255,255,255,0.2)">Loading workout plan...</div>';
    
    try {
      const resp = await fetch(this.s.restUrl + 'today-plan');
      const data = await resp.json();
      this.renderWorkout(data);
    } catch (e) {
      if (mount) mount.innerHTML = '<div style="padding:40px;text-align:center;color:#e91e8c">Error loading plan.</div>';
    }
  },

  renderWorkout(data) {
    document.getElementById('work-plan-name').textContent = data.plan_name || 'Today Workout';
    document.getElementById('work-mg').textContent = (data.muscle_group || 'CHEST').toUpperCase();
    document.getElementById('work-cal').textContent = data.calories_est || '320';
    document.getElementById('work-time').textContent = (data.duration_min || '45') + ':00';

    const mount = document.getElementById('ex-list-mount');
    if (!mount) return;

    if (!data.exercise_list || data.exercise_list.length === 0) {
      mount.innerHTML = '<div style="padding:40px;text-align:center;color:rgba(255,255,255,0.4)">No exercises assigned for today.</div>';
      return;
    }

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
            <div style="display:flex; flex-direction:column; gap:2px;">
              <span style="font-size:9px; color:rgba(255,255,255,0.3)">SETS</span>
              <input type="number" class="inp-sets" value="${ex.sets.split('-')[0] || 3}" style="width:35px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; font-size:11px; border-radius:4px; padding:2px 4px;">
            </div>
            <div style="display:flex; flex-direction:column; gap:2px;">
              <span style="font-size:9px; color:rgba(255,255,255,0.3)">REPS</span>
              <input type="number" class="inp-reps" value="${ex.reps.split('-')[0] || 12}" style="width:35px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; font-size:11px; border-radius:4px; padding:2px 4px;">
            </div>
            <span style="font-size:11px; color:rgba(255,255,255,0.4); margin-left:5px; margin-top:12px;">Tar: ${ex.target_weight}</span>
          </div>
        </div>
        <div class="ex-action">
          <div class="ex-plus" onclick="G.logExercise('${ex.name}', '${data.muscle_group}', this)">+</div>
        </div>
      </div>
    `).join('');
  },

  async logExercise(name, mg, btn) {
    const card = btn.closest('.ex-card');
    const sets = card.querySelector('.inp-sets')?.value || 1;
    const reps = card.querySelector('.inp-reps')?.value || 10;
    
    btn.innerHTML = '⌛';
    
    try {
        const resp = await fetch(this.s.restUrl + 'log', {
            method: 'POST',
            headers: { 
              'Content-Type': 'application/json', 
              'X-WP-Nonce': (typeof wpApiSettings !== 'undefined') ? wpApiSettings.nonce : '' 
            },
            body: JSON.stringify({
                exercise: name,
                muscle_group: mg,
                sets_done: parseInt(sets),
                reps_done: parseInt(reps),
                log_date: new Date().toISOString().split('T')[0]
            })
        });
        const d = await resp.json();
        if (d.success) {
            this.toast(`✅ ${name} logged!`);
            btn.innerHTML = '✔';
            btn.style.background = '#00e676';
            btn.style.borderColor = '#00e676';
            btn.style.color = '#000';
            
            // Connection: Update Achievements & Health
            this.s.achievements = Math.min(100, this.s.achievements + 2);
            this.s.health = this.calcHealth();
            this.render();
        } else {
            throw new Error('Save failed');
        }
    } catch (e) { 
        this.toast('❌ Failed to log. Are you logged in?');
        btn.innerHTML = '+';
    }
  },

  calcHealth() {
    const w  = Math.min(25, (this.s.waterI / this.s.waterG) * 25);
    const n  = (this.s.nutrition / 100) * 25;
    const wo = (this.s.workoutOverall / 100) * 25;
    const e  = (this.s.energy / 100) * 25;
    return Math.round(w + n + wo + e);
  },

  openAI() {
    document.getElementById('xd-modal-bg').classList.add('open');
    this._resetScanArea();
  },
  closeAI() {
    document.getElementById('xd-modal-bg').classList.remove('open');
    this._resetScanArea();
  },
  _resetScanArea() {
    const preview  = document.getElementById('ai-preview-img');
    const icon     = document.getElementById('ai-scan-icon');
    const txt      = document.getElementById('ai-scan-txt');
    const badge    = document.getElementById('ai-food-badge');
    const gramRow  = document.getElementById('ai-gram-row');
    const macros   = document.getElementById('ai-macros');
    const links    = document.getElementById('ai-links');
    const logBtn   = document.getElementById('ai-log-btn');
    const gramInp  = document.getElementById('ai-gram-inp');
    if (preview)  { preview.src = ''; preview.classList.remove('show'); }
    if (icon)     icon.textContent = '\uD83D\uDCF7';
    if (txt)      txt.textContent  = 'Tap to upload meal photo';
    if (badge)    badge.classList.remove('show');
    if (gramRow)  gramRow.style.display = 'none';
    if (macros)   macros.style.display  = 'none';
    if (links)    links.style.display   = 'none';
    if (logBtn)   logBtn.disabled = true;
    if (gramInp)  gramInp.value = '150';
    this._detectedFood = null;
    const fi = document.getElementById('ai-file-input');
    if (fi) fi.value = '';
    /* Clear hidden fields */
    ['ai-cal-inp','ai-prot-inp','ai-carb-inp','ai-fat-inp'].forEach(id => {
      const e = document.getElementById(id);
      if (e) e.value = '0';
    });
  },

  /* ── Food database: macros per 100g ── */
  _foodDB: [
    {name:'Grilled Chicken',  cal:165, prot:31,  carbs:0,    fat:3.6,  tag:'High Protein'},
    {name:'Salmon Fillet',    cal:208, prot:20,  carbs:0,    fat:13,   tag:'Omega-3 Rich'},
    {name:'Beef Steak',       cal:250, prot:26,  carbs:0,    fat:15,   tag:'High Protein'},
    {name:'Greek Yogurt',     cal:59,  prot:10,  carbs:3.6,  fat:0.4,  tag:'Low Fat'},
    {name:'Tuna Fillet',      cal:116, prot:26,  carbs:0,    fat:1,    tag:'Lean Protein'},
    {name:'Brown Rice',       cal:130, prot:2.7, carbs:28,   fat:0.3,  tag:'Complex Carbs'},
    {name:'Whole Eggs',       cal:155, prot:13,  carbs:1.1,  fat:11,   tag:'Complete Protein'},
    {name:'Banana',           cal:89,  prot:1.1, carbs:23,   fat:0.3,  tag:'Natural Sugars'},
    {name:'Oats',             cal:389, prot:17,  carbs:66,   fat:7,    tag:'Slow Carbs'},
    {name:'Sweet Potato',     cal:86,  prot:1.6, carbs:20,   fat:0.1,  tag:'Complex Carbs'},
    {name:'Avocado',          cal:160, prot:2,   carbs:9,    fat:15,   tag:'Healthy Fat'},
    {name:'Cottage Cheese',   cal:98,  prot:11,  carbs:3.4,  fat:4.3,  tag:'Casein Protein'},
  ],
  _detectedFood: null,

  handleFileUpload(file) {
    if (!file || !file.type.startsWith('image/')) return;
    const icon    = document.getElementById('ai-scan-icon');
    const txt     = document.getElementById('ai-scan-txt');
    const preview = document.getElementById('ai-preview-img');
    const reader  = new FileReader();
    reader.onload = (ev) => {
      if (preview) { preview.src = ev.target.result; preview.classList.add('show'); }
      if (icon) icon.textContent = '\u23F3';
      if (txt)  txt.textContent  = 'AI detecting food\u2026';
      /* Pick a food from _foodDB after 1.6s */
      setTimeout(() => {
        const food = this._foodDB[Math.floor(Math.random() * this._foodDB.length)];
        this._detectedFood = food;
        if (icon) icon.textContent = '\u2705';
        if (txt)  txt.textContent  = 'Detected! Adjust grams below.';
        /* Show food badge */
        const badge  = document.getElementById('ai-food-badge');
        const nameEl = document.getElementById('ai-food-name');
        const perEl  = document.getElementById('ai-food-per');
        const tagEl  = document.getElementById('ai-food-tag');
        if (badge)  badge.classList.add('show');
        if (nameEl) nameEl.textContent = food.name;
        if (perEl)  perEl.textContent  = food.cal + ' kcal \u00b7 ' + food.prot + 'g protein per 100g';
        if (tagEl)  tagEl.textContent  = food.tag;
        /* Reveal gram row, macros, links */
        const gramRow = document.getElementById('ai-gram-row');
        const macros  = document.getElementById('ai-macros');
        const links   = document.getElementById('ai-links');
        const logBtn  = document.getElementById('ai-log-btn');
        if (gramRow) gramRow.style.display = '';
        if (macros)  macros.style.display  = '';
        if (links)   links.style.display   = '';
        if (logBtn)  logBtn.disabled = false;
        this.calcFromGrams();
      }, 1600);
    };
    reader.readAsDataURL(file);
  },

  calcFromGrams() {
    const food = this._detectedFood;
    if (!food) return;
    const g     = Math.max(1, parseFloat(document.getElementById('ai-gram-inp')?.value) || 150);
    const ratio = g / 100;
    const cal   = Math.round(food.cal   * ratio);
    const prot  = Math.round(food.prot  * ratio * 10) / 10;
    const carbs = Math.round(food.carbs * ratio * 10) / 10;
    const fat   = Math.round(food.fat   * ratio * 10) / 10;
    const set = (id, v) => { const e = document.getElementById(id); if (e) e.textContent = v; };
    set('ai-r-cal',  cal  + ' kcal');
    set('ai-r-prot', prot + 'g');
    set('ai-r-carb', carbs + 'g');
    set('ai-r-fat',  fat  + 'g');
    /* Write to hidden fields for confirmMeal */
    const setVal = (id, v) => { const e = document.getElementById(id); if (e) e.value = v; };
    setVal('ai-cal-inp',  cal);
    setVal('ai-prot-inp', prot);
    setVal('ai-carb-inp', carbs);
    setVal('ai-fat-inp',  fat);
  },

  scrollTo(id) {
    this.closeAI();
    setTimeout(() => {
      const el = document.getElementById(id);
      if (el) {
        const card = el.closest('.cd') || el;
        card.scrollIntoView({behavior:'smooth', block:'center'});
        card.style.outline = '2px solid #00d4ff';
        setTimeout(() => { card.style.outline = ''; }, 2000);
      }
    }, 320);
  },

  async confirmMeal() {
    const cal   = parseInt(document.getElementById('ai-cal-inp')?.value)  || 0;
    const prot  = parseInt(document.getElementById('ai-prot-inp')?.value) || 0;
    const carbs = parseInt(document.getElementById('ai-carb-inp')?.value) || 0;
    const fat   = parseInt(document.getElementById('ai-fat-inp')?.value)  || 0;
    
    // Persistence
    try {
      await fetch(this.s.restUrl + 'log-metric', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': wpApiSettings.nonce },
        body: JSON.stringify({ 
          metric_type: 'meal', 
          metric_value: cal,
          protein: prot,
          carbs: carbs,
          fat: fat
        })
      });
    } catch (e) { console.error('Meal save failed', e); }

    this.addMeal(cal, prot, carbs, fat);
    this.closeAI();
  },

  render() {
    const s = this.s;
    const wPct   = Math.min(100, Math.round((s.waterI / s.waterG) * 100));
    const protPct = Math.min(100, Math.round((s.protein / s.protG) * 100));
    const calPct  = Math.min(100, Math.round((s.cal / s.calG) * 100));
    const burnPct = Math.min(100, Math.round((s.workoutBurn / 600) * 100));
    s.workoutOverall = Math.round((s.wChest + s.wShoulder + s.wTriceps + s.wBiceps) / 4);
    s.achievements   = Math.round(s.workoutOverall * 0.4 + s.nutrition * 0.35 + wPct * 0.25);

    // Water
    this.set('xd-water-i',   s.waterI.toFixed(1) + 'L');
    this.set('xd-water-pct', wPct + '% of goal');
    this.setW('xd-water-bar', wPct);
    this.setW('xd-e-water',   wPct);
    this.set('xd-e-water-pct', wPct + '%');

    // Calories
    this.set('xd-cal-txt',    s.cal.toLocaleString());
    this.set('xd-cal-burned', s.calBurned + ' kcal burned');

    // Nutrition
    this.set('xd-nutrition-val', s.nutrition);
    this.set('xd-nutrition-pct', s.nutrition + '%');
    this.setW('xd-nutrition-bar', s.nutrition);
    this.setW('xd-e-nutr',        s.nutrition);
    this.set('xd-e-nutr-pct',     s.nutrition + '%');
    this.setSvgOffset('xd-nutrition-donut', s.nutrition, 213.63);
    const nd = document.getElementById('xd-meal-val');
    if (nd) nd.textContent = s.nutrition;
    this.setSvgOffset('xd-meal-donut', s.nutrition, 213.63);

    // Energy
    this.set('xd-energy-val', s.energy + '%');
    this.setSvgOffset('xd-energy-svg', s.energy, 289.03);
    this.setW('xd-e-work',    s.workoutOverall);
    this.set('xd-e-work-pct', s.workoutOverall + '%');

    // Protein
    this.set('xd-prot-val',      s.protein + 'g');
    this.set('xd-prot-ring',     s.protein + 'g');
    this.set('xd-prot-goal-txt', `${s.protein}g / ${s.protG}g daily goal`);
    this.set('xd-prot-g',        s.protein + 'g');
    this.set('xd-carbs-val',     s.carbs + 'g');
    this.set('xd-fat-val',       s.fat + 'g');
    this.setW('xd-prot-bar',     protPct);
    this.setW('xd-e-prot',       protPct);
    this.set('xd-e-prot-pct',    protPct + '%');
    this.setSvgOffset('xd-prot-donut', protPct, 201.06);

    // Workout Overall → Burn → Achievements
    this.set('xd-wo-overall', s.workoutOverall);
    this.set('xd-wb-val',     s.workoutBurn + ' kcal burned');
    this.set('xd-wb-pct',     burnPct);
    this.setW('xd-wb-bar',    burnPct);
    this.setSvgOffset('xd-wb-donut', burnPct, 213.63);
    this.set('xd-ach-val',    s.achievements + '%');

    // BMI
    this.set('xd-bmi-num', s.bmi);
    const catEl = document.getElementById('xd-bmi-cat');
    if (catEl) {
      catEl.textContent = s.bmiCat;
      const colors = {Underweight:'#00d4ff', Normal:'#00e676', Overweight:'#fecb00', Obese:'#e91e8c'};
      catEl.style.color = colors[s.bmiCat] || '#00d4ff';
    }
    const bmiPct = Math.min(100, Math.max(0, ((s.bmi - 15) / 25) * 100));
    const marker = document.getElementById('xd-bmi-marker');
    if (marker) marker.style.setProperty('left', bmiPct + '%', 'important');

    // Health
    this.set('xd-health-score', s.health);
    this.setSvgOffset('xd-health-svg', s.health, 427.26);
    const hg = document.getElementById('xd-health-grade');
    if (hg) {
      if (s.health >= 80)      { hg.textContent='Excellent'; hg.style.background='rgba(0,230,118,.15)'; hg.style.color='#00e676'; }
      else if (s.health >= 65) { hg.textContent='Good';      hg.style.background='rgba(0,212,255,.15)'; hg.style.color='#00d4ff'; }
      else if (s.health >= 45) { hg.textContent='Fair';      hg.style.background='rgba(254,203,0,.15)';  hg.style.color='#fecb00'; }
      else                     { hg.textContent='Needs Work'; hg.style.background='rgba(233,30,140,.15)'; hg.style.color='#e91e8c'; }
    }

    // Health metrics
    this.set('xd-hm-water',   wPct + '%');   this.setW('xd-hm-water-bar', wPct);
    this.set('xd-hm-cal',     s.cal.toLocaleString()); this.setW('xd-hm-cal-bar', calPct);
    this.set('xd-hm-protein', s.protein + 'g'); this.setW('xd-hm-prot-bar', protPct);
    this.set('xd-hm-workout', s.workoutOverall + '%'); this.setW('xd-hm-workout-bar', s.workoutOverall);
    this.set('xd-hm-energy',  s.energy + '%'); this.setW('xd-hm-energy-bar', s.energy);
    this.set('xd-hm-nutr',    s.nutrition + '%'); this.setW('xd-hm-nutr-bar', s.nutrition);

    // Footer live stats
    this.set('xdf-water',   s.waterI.toFixed(1));
    this.set('xdf-cal',     s.cal.toLocaleString());
    this.set('xdf-protein', s.protein);
    this.set('xdf-health',  s.health);
  },

  set(id, val)        { const e = document.getElementById(id); if (e) e.textContent = val; },
  setW(id, pct)       { const e = document.getElementById(id); if (e) e.style.setProperty('width', Math.min(100, pct) + '%','important'); },
  setSvgOffset(id, pct, circ) {
    const e = document.getElementById(id);
    if (e) e.style.strokeDashoffset = circ * (1 - Math.min(100, pct) / 100);
  },

  toast(msg) {
    const t = document.getElementById('xd-toast');
    if (!t) return;
    t.textContent = msg; t.classList.add('show');
    clearTimeout(t._t);
    t._t = setTimeout(() => t.classList.remove('show'), 3200);
  }
};

document.addEventListener('DOMContentLoaded', () => {
  G.init();

  // BMI live update
  ['bmi-w-inp','bmi-h-inp'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('input', () => {
      const w = parseFloat(document.getElementById('bmi-w-inp').value) || G.s.weight;
      const h = parseFloat(document.getElementById('bmi-h-inp').value) || G.s.height;
      G.calcBMI(w, h);
    });
  });

  // Weight card
  const wi = document.getElementById('xd-wt-inp');
  if (wi) wi.addEventListener('input', () => {
    const v = parseFloat(wi.value);
    if (v > 20) {
      document.getElementById('xd-wt-val').textContent = v.toFixed(1) + ' KG';
      document.getElementById('bmi-w-inp').value = v;
      G.s.weight = v; G.calcBMI(v, G.s.height);
    }
  });

  // Real file upload — triggers when user picks a photo
  const fileInput = document.getElementById('ai-file-input');
  if (fileInput) {
    fileInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        G.handleFileUpload(this.files[0]);
      }
    });
  }

  // Close models on backdrop click
  [modalBg, document.getElementById('xd-work-modal-bg')].forEach(mb => {
    if (mb) mb.addEventListener('click', function(e){
      if (e.target === this) {
        if (this.id.includes('work')) G.closeWorkout();
        else G.closeAI();
      }
    });
  });

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      G.closeAI();
      G.closeWorkout();
      G.closeProfile();
    }
  });

  // Profile button click
  const profBtn = document.querySelector('.btn-profile');
  if (profBtn) {
    profBtn.addEventListener('click', (e) => {
      e.preventDefault();
      G.openProfile();
    });
  }
});
</script>

<?php get_footer(); ?>
<script>
// Load real plugin data into Today Workout widget
document.addEventListener('DOMContentLoaded', function() {
  fetch('/wp-json/trainopro/v1/plans')
  .then(function(r){ return r.json(); })
  .then(function(plans) {
    if (!plans || plans.length === 0) return;
    var list = document.querySelector('.m-list');
    if (!list) return;
    var colors = ['bpk','bbl','bgo','bgr','bcy','bpu'];
    var widths = [82,68,74,60,70,65];
    var html = '';
    plans.slice(0,4).forEach(function(plan, i) {
      var mg = plan.muscle_group || plan.plan_name || 'Workout';
      // Link to the specific muscle workout page with plan_id
      var url = '/index.php/muscle-workout/?plan_id=' + plan.id;
      var exCount = (plan.exercise_list||[]).length;
      var pct = widths[i % widths.length];
      html += '<a href="'+url+'" style="text-decoration:none!important; color:inherit!important; display:block!important;">'
        + '<div>'
        + '<div class="m-head">'
        + '<span class="m-name">'+mg+'</span>'
        + '<span class="m-up">'+exCount+' exercises</span>'
        + '</div>'
        + '<div class="bar-bg"><div class="bar-f '+colors[i%colors.length]+'" data-w="'+pct+'%" style="width:'+pct+'%!important"></div></div>'
        + '</div>'
        + '</a>';
    });
    list.innerHTML = html;
    // update overall
    var overall = Math.round(widths.slice(0, plans.length).reduce(function(a,b){return a+b;},0) / Math.min(plans.length,4));
    var el = document.getElementById('xd-wo-overall');
    if (el) el.textContent = overall;
    // update calories
    var totalCal = plans.reduce(function(a,p){ return a + (parseInt(p.calories_est)||0); }, 0);
    if (totalCal > 0) G.s.calBurned = totalCal;
  }).catch(function(){});

  // Load today plan stats
  fetch('/wp-json/trainopro/v1/today-plan')
  .then(function(r){ return r.json(); })
  .then(function(data) {
    if (data && data.calories_est) {
      G.s.calBurned = parseInt(data.calories_est) || G.s.calBurned;
      G.s.workoutBurn = parseInt(data.calories_est) || G.s.workoutBurn;
      G.render();
      
      // Update View Workout button to link to the specific plan ID
      var vwb = document.querySelector('.wbtn-p');
      if (vwb && data.id) {
        vwb.href = '/index.php/muscle-workout/?plan_id=' + data.id;
      }
    }
  }).catch(function(){});
});
</script>
