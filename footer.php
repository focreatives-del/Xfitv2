    <footer id="xd-footer">
        <div class="xdf-top">
            <div class="xdf-brand">
                <span class="xdf-logo">TRAIN<span>O</span>PRO</span>
                <p>Your premium fitness companion. Track workouts, nutrition, and health with intelligence.</p>
                <div class="xdf-social">
                    <a href="#" class="soc-icon">📸</a>
                    <a href="#" class="soc-icon">🐦</a>
                    <a href="#" class="soc-icon">▶️</a>
                </div>
            </div>
            <div class="xdf-links">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="<?php echo home_url('/'); ?>">Dashboard</a></li>
                    <li><a href="<?php echo home_url('/index.php/workout/'); ?>">Workout Plans</a></li>
                    <li><a href="<?php echo home_url('/diet-plan'); ?>">Diet Plans</a></li>
                </ul>
            </div>
            <div class="xdf-contact">
                <h5>Contact Us</h5>
                <p>support@trainopro.com</p>
                <p>+1 234 567 8900</p>
            </div>
        </div>
        <div class="xdf-bottom">
            <p>&copy; <?php echo date('Y'); ?> Traino Pro. All rights reserved.</p>
            <div class="xdf-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<style>
#xd-footer {
    background: #0d0d10;
    border-top: 1px solid rgba(255,255,255,0.05);
    padding: 80px 40px 40px;
    color: #fff;
    font-family: 'DM Sans', sans-serif;
}
.xdf-top {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 60px;
    max-width: 1200px;
    margin: 0 auto 60px;
}
.xdf-logo {
    font-family: 'Syne', sans-serif;
    font-size: 28px;
    font-weight: 900;
    letter-spacing: 2px;
    color: #fff;
    display: block;
    margin-bottom: 20px;
}
.xdf-logo span { color: #e91e8c; }
.xdf-brand p {
    color: rgba(255,255,255,0.5);
    line-height: 1.6;
    margin-bottom: 24px;
    font-size: 14px;
}
.xdf-social { display: flex; gap: 12px; }
.soc-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s;
}
.soc-icon:hover { background: #e91e8c; transform: translateY(-3px); }
.xdf-links h5, .xdf-contact h5 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 24px;
    color: #00d4ff;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.xdf-links ul { list-style: none; padding: 0; margin: 0; }
.xdf-links li { margin-bottom: 12px; }
.xdf-links a {
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s;
}
.xdf-links a:hover { color: #fff; }
.xdf-contact p {
    color: rgba(255,255,255,0.6);
    font-size: 14px;
    margin-bottom: 10px;
}
.xdf-bottom {
    max-width: 1200px;
    margin: 0 auto;
    padding-top: 30px;
    border-top: 1px solid rgba(255,255,255,0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    color: rgba(255,255,255,0.4);
}
.xdf-legal a {
    color: rgba(255,255,255,0.4);
    text-decoration: none;
    margin-left: 24px;
}
@media (max-width: 768px) {
    .xdf-top { grid-template-columns: 1fr; gap: 40px; }
    .xdf-bottom { flex-direction: column; gap: 16px; text-align: center; }
}
</style>

<?php wp_footer(); ?>
</body>
</html>
