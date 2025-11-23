@include('livewire.includes.page-hero')

<section class="service-details p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                @include('livewire.includes.left-menu')
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">

                <div class="bmi-calculator-wrapper">
                    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">{{ gt('bmi_calculator', 'BMI
                        Calculator') }}</h2>

                    <!-- Unit Selection Tabs -->
                    <div class="unit-tabs" style="margin-bottom: 30px; text-align: center;">
                        <button type="button" class="unit-tab active" data-unit="metric"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: #3498db; color: white; border-radius: 5px; cursor: pointer; font-size: 16px;">{{
                            gt('metric_units', 'Metric Units') }}</button>
                        <button type="button" class="unit-tab" data-unit="us"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: white; color: #3498db; border-radius: 5px; cursor: pointer; font-size: 16px;">{{
                            gt('us_units', 'US Units') }}</button>
                    </div>

                    <!-- BMI Form -->
                    <form id="bmi-form">
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{
                                    gt('age', 'Age') }}</label>
                                <input type="number" id="age" class="form-control"
                                    placeholder="{{ gt('age_placeholder', 'Age (2-120)') }}" min="2" max="120"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                            </div>
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{
                                    gt('gender', 'Gender') }}</label>
                                <select id="gender" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="male">{{ gt('male', 'Male') }}</option>
                                    <option value="female">{{ gt('female', 'Female') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Metric Units Form -->
                        <div id="metric-form" class="unit-form">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{
                                        gt('height_cm', 'Height (cm)') }}</label>
                                    <input type="number" id="height-cm" class="form-control"
                                        placeholder="{{ gt('height_cm_placeholder', 'Height in cm') }}" step="0.1"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{
                                        gt('weight_kg', 'Weight (kg)') }}</label>
                                    <input type="number" id="weight-kg" class="form-control"
                                        placeholder="{{ gt('weight_kg_placeholder', 'Weight in kg') }}" step="0.1"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                            </div>
                        </div>

                        <!-- US Units Form -->
                        <div id="us-form" class="unit-form" style="display: none;">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{
                                        gt('height', 'Height') }}</label>
                                    <div style="display: flex; gap: 10px;">
                                        <input type="number" id="height-ft" class="form-control"
                                            placeholder="{{ gt('feet', 'Feet') }}" min="0"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                        <input type="number" id="height-in" class="form-control"
                                            placeholder="{{ gt('inches', 'Inches') }}" min="0" max="11" step="0.1"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{
                                        gt('weight_lbs', 'Weight (lbs)') }}</label>
                                    <input type="number" id="weight-lbs" class="form-control"
                                        placeholder="{{ gt('weight_lbs_placeholder', 'Weight in pounds') }}" step="0.1"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 30px;">
                            <button type="submit"
                                style="padding: 15px 60px; background: #27ae60; color: white; border: none; border-radius: 5px; font-size: 18px; font-weight: 600; cursor: pointer; transition: all 0.3s;">{{
                                gt('calculate_bmi', 'Calculate BMI') }}</button>
                        </div>
                    </form>

                    <!-- Results Section -->
                    <div id="bmi-result" style="margin-top: 40px; display: none;">
                        <div style="background: #ecf0f1; padding: 30px; border-radius: 10px; text-align: center;">
                            <h3 style="color: #2c3e50; margin-bottom: 20px;">{{ gt('result', 'Result') }}</h3>
                            <div id="bmi-value"
                                style="font-size: 36px; font-weight: bold; color: #3498db; margin-bottom: 10px;">
                            </div>
                            <div id="bmi-category" style="font-size: 24px; font-weight: 600; margin-bottom: 20px;">
                            </div>

                            <!-- BMI Visual Indicator -->
                            <div
                                style="position: relative; height: 40px; background: linear-gradient(to right, #3498db 0%, #2ecc71 25%, #f39c12 50%, #e74c3c 75%, #c0392b 100%); border-radius: 20px; margin: 30px 0; overflow: hidden;">
                                <div id="bmi-indicator"
                                    style="position: absolute; top: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: white; border: 3px solid #2c3e50; border-radius: 50%; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                                </div>
                            </div>

                            <div style="text-align: left; margin-top: 30px;">
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('bmi_prime', 'BMI Prime') }}:</strong> <span id="bmi-prime"></span>
                                </div>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('ponderal_index', 'Ponderal Index') }}:</strong> <span
                                        id="ponderal-index"></span>
                                </div>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('healthy_bmi_range', 'Healthy BMI range') }}:</strong> 18.5 kg/m² - 25
                                    kg/m²
                                </div>
                                <div style="font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('healthy_weight_range', 'Healthy weight range') }}:</strong> <span
                                        id="healthy-weight"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BMI Information -->
                    <div style="margin-top: 50px;">
                        <h3 style="color: #2c3e50; margin-bottom: 20px;">{{ gt('about_bmi', 'About BMI') }}</h3>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            The Body Mass Index (BMI) Calculator can be used to calculate BMI value and
                            corresponding weight
                            status while taking age into consideration. BMI is a measurement of a person's
                            leanness or
                            corpulence based on their height and weight, and is intended to quantify tissue
                            mass.
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">BMI Categories
                            (Adults)</h4>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                            <thead>
                                <tr style="background: #34495e; color: white;">
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">
                                        Classification</th>
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">BMI
                                        Range (kg/m²)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Severe Thinness</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">
                                        < 16</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Moderate Thinness
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">16 - 17</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Mild Thinness</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">17 - 18.5</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">
                                        <strong>Normal</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd;"><strong>18.5 -
                                            25</strong></td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Overweight</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">25 - 30</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Obese Class I</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">30 - 35</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Obese Class II</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">35 - 40</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Obese Class III</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">> 40</td>
                                </tr>
                            </tbody>
                        </table>

                        <div
                            style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; margin-top: 30px; border-radius: 5px;">
                            <h4 style="color: #856404; margin-bottom: 10px;">Important Note</h4>
                            <p style="color: #856404; margin: 0; line-height: 1.6;">
                                BMI is a useful indicator of health at the population level. However, the
                                distribution of
                                muscle and bone mass can vary greatly from person to person. BMI should be
                                considered along
                                with other measurements and factors rather than being used as the sole
                                method for
                                determining a person's healthy body weight.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



<script>
    document.addEventListener('DOMContentLoaded', function() {
    const unitTabs = document.querySelectorAll('.unit-tab');
    const metricForm = document.getElementById('metric-form');
    const usForm = document.getElementById('us-form');
    const bmiForm = document.getElementById('bmi-form');
    const bmiResult = document.getElementById('bmi-result');
    let currentUnit = 'metric';

    // Unit tab switching
    unitTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            unitTabs.forEach(t => {
                t.style.background = 'white';
                t.style.color = '#3498db';
            });
            this.style.background = '#3498db';
            this.style.color = 'white';

            currentUnit = this.dataset.unit;
            if (currentUnit === 'metric') {
                metricForm.style.display = 'block';
                usForm.style.display = 'none';
            } else {
                metricForm.style.display = 'none';
                usForm.style.display = 'block';
            }
            bmiResult.style.display = 'none';
        });
    });

    // BMI Calculation
    bmiForm.addEventListener('submit', function(e) {
        e.preventDefault();

        let heightInMeters, weightInKg;

        if (currentUnit === 'metric') {
            const heightCm = parseFloat(document.getElementById('height-cm').value);
            weightInKg = parseFloat(document.getElementById('weight-kg').value);

            if (!heightCm || !weightInKg || heightCm <= 0 || weightInKg <= 0) {
                alert('Please enter valid height and weight values.');
                return;
            }

            heightInMeters = heightCm / 100;
        } else {
            const heightFt = parseFloat(document.getElementById('height-ft').value) || 0;
            const heightIn = parseFloat(document.getElementById('height-in').value) || 0;
            const weightLbs = parseFloat(document.getElementById('weight-lbs').value);

            if ((heightFt === 0 && heightIn === 0) || !weightLbs || weightLbs <= 0) {
                alert('Please enter valid height and weight values.');
                return;
            }

            // Convert to metric
            const totalInches = (heightFt * 12) + heightIn;
            heightInMeters = totalInches * 0.0254;
            weightInKg = weightLbs * 0.453592;
        }

        // Calculate BMI
        const bmi = weightInKg / (heightInMeters * heightInMeters);
        const bmiPrime = bmi / 25;
        const ponderalIndex = weightInKg / Math.pow(heightInMeters, 3);

        // Determine category and color
        let category, categoryColor;
        if (bmi < 16) {
            category = 'Severe Thinness';
            categoryColor = '#3498db';
        } else if (bmi < 17) {
            category = 'Moderate Thinness';
            categoryColor = '#3498db';
        } else if (bmi < 18.5) {
            category = 'Mild Thinness';
            categoryColor = '#3498db';
        } else if (bmi < 25) {
            category = 'Normal';
            categoryColor = '#2ecc71';
        } else if (bmi < 30) {
            category = 'Overweight';
            categoryColor = '#f39c12';
        } else if (bmi < 35) {
            category = 'Obese Class I';
            categoryColor = '#e74c3c';
        } else if (bmi < 40) {
            category = 'Obese Class II';
            categoryColor = '#e74c3c';
        } else {
            category = 'Obese Class III';
            categoryColor = '#c0392b';
        }

        // Calculate healthy weight range
        const minHealthyWeight = 18.5 * (heightInMeters * heightInMeters);
        const maxHealthyWeight = 25 * (heightInMeters * heightInMeters);

        let healthyWeightText;
        if (currentUnit === 'metric') {
            healthyWeightText = `${minHealthyWeight.toFixed(1)} kg - ${maxHealthyWeight.toFixed(1)} kg`;
        } else {
            const minLbs = minHealthyWeight * 2.20462;
            const maxLbs = maxHealthyWeight * 2.20462;
            healthyWeightText = `${minLbs.toFixed(1)} lbs - ${maxLbs.toFixed(1)} lbs`;
        }

        // Display results
        document.getElementById('bmi-value').textContent = `BMI = ${bmi.toFixed(1)} kg/m²`;
        document.getElementById('bmi-category').textContent = category;
        document.getElementById('bmi-category').style.color = categoryColor;
        document.getElementById('bmi-prime').textContent = bmiPrime.toFixed(2);
        document.getElementById('ponderal-index').textContent = `${ponderalIndex.toFixed(1)} kg/m³`;
        document.getElementById('healthy-weight').textContent = healthyWeightText;

        // Position indicator (BMI range roughly 15-40 mapped to 0-100%)
        const indicatorPosition = Math.min(Math.max((bmi - 15) / 25 * 100, 0), 100);
        document.getElementById('bmi-indicator').style.left = indicatorPosition + '%';

        // Show results
        bmiResult.style.display = 'block';

        // Smooth scroll to results
        bmiResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    // Hover effect for calculate button
    const calculateBtn = bmiForm.querySelector('button[type="submit"]');
    calculateBtn.addEventListener('mouseenter', function() {
        this.style.background = '#229954';
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 4px 15px rgba(39, 174, 96, 0.3)';
    });
    calculateBtn.addEventListener('mouseleave', function() {
        this.style.background = '#27ae60';
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
    });
});
</script>
