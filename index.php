<?php get_header(); ?>

<main id="primary" class="site-main dashboard-main">

    <!-- HERO SECTION (Dynamic Slider) -->
    <section class="hero-banner container">
        <div class="hero-slider-wrapper">
        <?php echo do_shortcode("[dynamic_slider]"); ?> 
        </div>
    </section>

    <!-- DASHBOARD CONTENT ROW 1 - NEW LAYOUT -->
    <section class="dashboard-row-1 container new-layout">
        
        <!-- LEFT COLUMN: 4 Stacked Cards -->
        <div class="left-column">
            
            <!-- Card 1: Calories -->
            <div class="dash-card small-card">
                <div class="card-horizontal">
                    <div class="circle-icon pink-ring"><span id="cal-val">98</span></div>
                    <div class="card-text">
                        <span class="card-label">Calories</span>
                    </div>
                    <div class="add-btn-circle"><i>➕</i></div>
                </div>
            </div>

            <!-- Card 2: Calories After workout -->
            <div class="dash-card small-card">
                <div class="card-horizontal">
                    <div class="circle-icon purple-ring"><span id="cal-after-val">98</span></div>
                    <div class="card-text">
                        <span class="card-label">Calories</span>
                        <span class="card-sublabel">After workout</span>
                    </div>
                    <div class="add-btn-circle"><i>➕</i></div>
                </div>
            </div>

            <!-- Card 3: Weight -->
            <div class="dash-card small-card">
                <div class="card-horizontal">
                    <div class="circle-icon red-ring"><span id="weight-val">98</span></div>
                    <div class="card-text">
                        <span class="card-label">Weight</span>
                        <div class="weight-sub">
                            <span class="subtitle-small">Ideal weight</span>
                            <span class="value-small">75 KG</span>
                        </div>
                    </div>
                    <div class="add-btn-circle"><i>➕</i></div>
                </div>
            </div>

            <!-- Card 4: Overall active ments with graph -->
            <div class="dash-card graph-card">
                <h4>Overoll active ments</h4>
                <div class="legend-dots">
                    <span class="legend-item"><span class="dot cyan"></span> YOUR BIOT</span>
                    <span class="legend-item"><span class="dot pink"></span> YOUR BIOT</span>
                </div>
                <div class="graph-container">
                    <canvas id="activity-graph"></canvas>
                </div>
            </div>
        </div>

        <!-- MIDDLE COLUMN: Today Workout Card (Larger) -->
        <div class="middle-column">
            <div class="dash-card today-workout-card">
                <div class="workout-header">
                    <h3>Today workout</h3>
                    <div class="add-btn-circle"><i>➕</i></div>
                </div>
                
                <div class="workout-body-new">
                    <!-- Left: Progress bars -->
                    <div class="workout-stats">
                        <div class="stat-item">
                            <div class="stat-title-row">
                                <h4>Chest</h4>
                                <span class="uptime"><span class="dot cyan"></span> Uptime: 99.99%</span>
                            </div>
                            <div class="linear-progress">
                                <div class="progress-bar pink-gradient" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-title-row">
                                <h4>Shoulder</h4>
                                <span class="uptime"><span class="dot cyan"></span> Uptime: 99.99%</span>
                            </div>
                            <div class="linear-progress">
                                <div class="progress-bar blue-gradient" style="width: 60%"></div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-title-row">
                                <h4>Triceps</h4>
                                <span class="uptime"><span class="dot cyan"></span> Uptime: 99.99%</span>
                            </div>
                            <div class="linear-progress">
                                <div class="progress-bar yellow-gradient" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right: Overall circle and buttons -->
                    <div class="workout-overall">
                        <div class="large-circle-chart multi-gradient">
                            <div class="circle-bg"></div>
                            <div class="circle-value" id="overall-workout">98</div>
                        </div>
                        <p class="overall-label">Overoll</p>
                        <div class="action-buttons">
                            <button class="btn-pill outline">View workout</button>
                            <button class="btn-pill outline">Workout Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: 2 Water Cards -->
        <div class="right-column">
            
            <!-- Card 1: Required Water -->
            <div class="dash-card water-card">
                <div class="card-horizontal-water">
                    <div class="circle-icon-large pink-ring"><span class="water-val">3L</span></div>
                    <div class="card-text-right">
                        <span class="card-label">Required Water</span>
                    </div>
                    <div class="add-btn-circle"><i>➕</i></div>
                </div>
            </div>

            <!-- Card 2: Today Intake -->
            <div class="dash-card water-card">
                <div class="card-horizontal-water">
                    <div class="circle-icon-large multi-color-ring"><span class="water-val">1.5L</span></div>
                    <div class="card-text-right">
                        <span class="card-label">Today Intake</span>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- DASHBOARD CONTENT ROW 2: Three Cards -->
    <section class="dashboard-row-2 container">
        
        <div class="dash-card feature-card">
            <h4>Workout Burn</h4>
            <div class="linear-progress thin">
                <div class="progress-bar yellow-gradient" style="width: 40%"></div>
            </div>
            <div class="status-row">
                <h3 class="status-main">Healthy <span class="dot cyan"></span></h3>
                <span class="uptime">Uptime: 99.99%</span>
            </div>
            <div class="card-footer-flex">
                <p>Linked to Today's Workout</p>
            </div>
        </div>

        <div class="dash-card feature-card">
            <h4>Daily meals details</h4>
            <div class="linear-progress thin">
                <div class="progress-bar orange-gradient" style="width: 50%"></div>
            </div>
            <div class="status-row">
                <h3 class="status-main">Healthy <span class="dot cyan"></span></h3>
                <span class="uptime">Uptime: 99.99%</span>
            </div>
            <div class="card-footer-flex">
                <p>AI Meal Scanner 📸</p>
            </div>
        </div>

        <div class="dash-card feature-card">
            <h4>Nutritions</h4>
            <div class="linear-progress thin">
                <div class="progress-bar cyan-gradient" style="width: 30%"></div>
            </div>
            <div class="status-row">
                <h3 class="status-main">Healthy <span class="dot cyan"></span></h3>
                <span class="uptime">Uptime: 99.99%</span>
            </div>
            <div class="card-footer-flex">
                <p>Linked to Water & Protein.</p>
            </div>
        </div>

    </section>

    <!-- DASHBOARD CONTENT ROW 3: Supplements -->
    <section class="dashboard-row-3 container">
        <div class="dash-card supplements-card">
            <div class="supp-grid-4">
                
                <div class="supp-item">
                    <h4>Multi vitamin</h4>
                    <div class="linear-progress ultra-thin">
                        <div class="progress-bar cyan-purple-gradient" style="width: 60%"></div>
                    </div>
                    <div class="supp-footer">
                        <span class="days">30 Days</span>
                        <div class="outline-circle purple"></div>
                    </div>
                </div>

                <div class="supp-item">
                    <h4>Magnesium</h4>
                    <div class="linear-progress ultra-thin">
                        <div class="progress-bar yellow-gradient" style="width: 20%"></div>
                    </div>
                    <div class="supp-footer">
                        <span class="days">8 Days</span>
                        <div class="outline-circle yellow"></div>
                    </div>
                </div>

                <div class="supp-item">
                    <h4>Zink</h4>
                    <div class="linear-progress ultra-thin">
                        <div class="progress-bar yellow-gradient" style="width: 25%"></div>
                    </div>
                    <div class="supp-footer">
                        <span class="days">10 Days</span>
                        <div class="outline-circle yellow"></div>
                    </div>
                </div>

                <div class="supp-item">
                    <h4>Omega 3</h4>
                    <div class="linear-progress ultra-thin">
                        <div class="progress-bar yellow-cyan-gradient" style="width: 15%"></div>
                    </div>
                    <div class="supp-footer">
                        <span class="days">6 Days</span>
                        <div class="outline-circle cyan"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
// Simple line chart for "Overall active ments"
const ctx = document.getElementById('activity-graph');
if (ctx) {
    const gradient1 = ctx.getContext('2d').createLinearGradient(0, 0, 0, 150);
    gradient1.addColorStop(0, 'rgba(0, 212, 255, 0.3)');
    gradient1.addColorStop(1, 'rgba(0, 212, 255, 0)');
    
    const gradient2 = ctx.getContext('2d').createLinearGradient(0, 0, 0, 150);
    gradient2.addColorStop(0, 'rgba(255, 0, 150, 0.3)');
    gradient2.addColorStop(1, 'rgba(255, 0, 150, 0)');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array(20).fill(''),
            datasets: [{
                data: [30, 40, 35, 50, 49, 60, 70, 91, 85, 75, 80, 90, 85, 80, 75, 70, 65, 60, 55, 50],
                borderColor: '#00D4FF',
                backgroundColor: gradient1,
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }, {
                data: [20, 30, 45, 40, 60, 50, 65, 70, 80, 85, 75, 70, 75, 80, 85, 90, 85, 80, 75, 70],
                borderColor: '#FF0096',
                backgroundColor: gradient2,
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { display: false },
                y: { display: false }
            }
        }
    });
}
</script>

<?php get_footer(); ?>
