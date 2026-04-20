/**
 * Trainopro Neon - Main JavaScript & State Manager
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ===================================================================
     * 1. APP STATE MANAGEMENT
     * =================================================================== */
    const State = {
        water: 0,
        protein: 0,
        calories: 98,
        meals: 0, // 0 to 100%
        vitamins: JSON.parse(localStorage.getItem('trainopro_vits')) || {
            multivitamin: 0,
            magnesium: 0,
            zink: 0,
            omega3: 0
        }
    };

    // UI Elements map
    const UI = {
        waterVal: document.getElementById('water-val'),
        proteinVal: document.getElementById('protein-val'),
        calVal: document.getElementById('cal-val'),
        nutritionBar: document.getElementById('nutrition-bar'),
        mealsBar: document.getElementById('meals-bar'),
        workoutBurn: document.getElementById('workout-burn-bar')
    };

    // Render Function: Updates all connected UI when state changes
    function renderState() {
        // Update direct text
        if(UI.waterVal) UI.waterVal.innerText = State.water;
        if(UI.proteinVal) UI.proteinVal.innerText = State.protein;
        if(UI.calVal) UI.calVal.innerText = State.calories;

        // Calculate combined "Nutrition" percent (Mock logic)
        let nutPercent = Math.min((State.protein / 200 * 50) + (State.water * 10), 100);
        if(UI.nutritionBar) UI.nutritionBar.style.width = nutPercent + '%';

        // Update meals bar based on ML/AI scans
        if(UI.mealsBar) UI.mealsBar.style.width = State.meals + '%';
        
        // Render Vitamin Days & Bars
        for (const [key, days] of Object.entries(State.vitamins)) {
            const dayLabel = document.getElementById(`days-${key}`);
            const bar = document.getElementById(`bar-${key}`);
            const circle = document.querySelector(`.clickable-vit[data-vit="${key}"]`);
            
            if(dayLabel) dayLabel.innerText = days;
            if(bar) bar.style.width = Math.min((days / 30) * 100, 100) + '%';
            
            // Highlight today's circle if clicked
            // Basic mock: we toggle a class when interacting.
        }

        // Save vitamins to local storage
        localStorage.setItem('trainopro_vits', JSON.stringify(State.vitamins));
    }

    /* ===================================================================
     * 2. EVENT LISTENERS
     * =================================================================== */

    // Add Water Button (Links to Water & Nutrition)
    const btnWater = document.getElementById('btn-add-water');
    if (btnWater) {
        btnWater.addEventListener('click', () => {
            State.water += 1;
            renderState();
        });
    }

    // Add Protein ML Form
    const btnProtein = document.getElementById('btn-add-protein');
    const inputProtein = document.getElementById('ml-protein-input');
    if (btnProtein && inputProtein) {
        btnProtein.addEventListener('click', () => {
            const val = parseInt(inputProtein.value);
            if (!isNaN(val)) {
                State.protein += val;
                inputProtein.value = '';
                
                // Adding protein also bumps meals slightly
                State.meals = Math.min(State.meals + 15, 100);
                
                // Bumping meal increases calories 
                State.calories += Math.floor(Math.random() * 200 + 50);

                renderState();
            }
        });
    }

    // AI Camera Button (Mock)
    const btnCamera = document.getElementById('btn-camera');
    if (btnCamera) {
        btnCamera.addEventListener('click', () => {
            btnCamera.innerText = '⏳'; // Loading state
            setTimeout(() => {
                alert('AI Vision Analysis Complete: Detected Chicken & Rice. +450 Calories, +40g Protein.');
                State.calories += 450;
                State.protein += 40;
                State.meals = Math.min(State.meals + 30, 100);
                btnCamera.innerText = '📸'; // Reset
                renderState();
            }, 1500);
        });
    }

    // Clickable Vitamins
    const vitCircles = document.querySelectorAll('.clickable-vit');
    vitCircles.forEach(circle => {
        circle.addEventListener('click', function() {
            const vitType = this.dataset.vit;
            
            // Toggle Visual Active State
            this.classList.add('active');
            
            // Increment Days IF it's below 30 (Mock logic for today)
            if (State.vitamins[vitType] < 30) {
                State.vitamins[vitType]++;
                renderState();
            }

            // In a real app, we'd check if they already took it today via timestamp
        });
    });

    /* ===================================================================
     * 3. UI ANIMATIONS (Intersection Observer)
     * =================================================================== */
    const progressBars = document.querySelectorAll('.progress-bar:not(.vit-bar)');
    progressBars.forEach(bar => {
        if (!bar.id) { // Only animate static bars, not state-linked ones on load
            bar.dataset.width = bar.style.width;
            bar.style.width = '0%';
            bar.style.transition = 'width 1.5s cubic-bezier(0.22, 1, 0.36, 1)';
        }
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                if(bar.dataset.width) {
                    bar.style.width = bar.dataset.width;
                }
                observer.unobserve(bar);
            }
        });
    }, { threshold: 0.5 });
    
    progressBars.forEach(bar => observer.observe(bar));

    // Initialize state render on load
    renderState();

});
