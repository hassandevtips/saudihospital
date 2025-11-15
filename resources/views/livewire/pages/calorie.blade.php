@include('livewire.includes.page-hero')

<section class="service-details p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                @include('livewire.includes.left-menu')
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">

                <div class="calorie-calculator-wrapper">
                    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">Calorie Calculator</h2>

                    <!-- Unit Selection Tabs -->
                    <div class="unit-tabs" style="margin-bottom: 30px; text-align: center;">
                        <button type="button" class="unit-tab active" data-unit="metric"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: #3498db; color: white; border-radius: 5px; cursor: pointer; font-size: 16px;">Metric
                            Units</button>
                        <button type="button" class="unit-tab" data-unit="us"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: white; color: #3498db; border-radius: 5px; cursor: pointer; font-size: 16px;">US
                            Units</button>
                    </div>

                    <!-- Calorie Form -->
                    <form id="calorie-form">
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Age</label>
                                <input type="number" id="age" class="form-control" placeholder="Age (15-80)" min="15"
                                    max="80"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                            </div>
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Gender</label>
                                <select id="gender" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <!-- Metric Units Form -->
                        <div id="metric-form" class="unit-form">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Height
                                        (cm)</label>
                                    <input type="number" id="height-cm" class="form-control" placeholder="Height in cm"
                                        step="0.1"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Weight
                                        (kg)</label>
                                    <input type="number" id="weight-kg" class="form-control" placeholder="Weight in kg"
                                        step="0.1"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                            </div>
                        </div>

                        <!-- US Units Form -->
                        <div id="us-form" class="unit-form" style="display: none;">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Height</label>
                                    <div style="display: flex; gap: 10px;">
                                        <input type="number" id="height-ft" class="form-control" placeholder="Feet"
                                            min="0"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                        <input type="number" id="height-in" class="form-control" placeholder="Inches"
                                            min="0" max="11" step="0.1"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Weight
                                        (lbs)</label>
                                    <input type="number" id="weight-lbs" class="form-control"
                                        placeholder="Weight in pounds" step="0.1"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                            </div>
                        </div>

                        <!-- Activity Level -->
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-12" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Activity
                                    Level</label>
                                <select id="activity" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="1.2">Basal Metabolic Rate (BMR)</option>
                                    <option value="1.2">Sedentary: little or no exercise</option>
                                    <option value="1.375">Light: exercise 1-3 times/week</option>
                                    <option value="1.55" selected>Moderate: exercise 4-5 times/week</option>
                                    <option value="1.725">Active: daily exercise or intense exercise 3-4 times/week
                                    </option>
                                    <option value="1.9">Very Active: intense exercise 6-7 times/week</option>
                                </select>
                            </div>
                        </div>

                        <!-- BMR Formula Selection -->
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-12" style="padding: 0 10px;">
                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">BMR
                                    Estimation Formula</label>
                                <select id="formula" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="mifflin" selected>Mifflin St Jeor</option>
                                    <option value="harris">Revised Harris-Benedict</option>
                                </select>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 30px;">
                            <button type="submit"
                                style="padding: 15px 60px; background: #27ae60; color: white; border: none; border-radius: 5px; font-size: 18px; font-weight: 600; cursor: pointer; transition: all 0.3s;">Calculate</button>
                        </div>
                    </form>

                    <!-- Results Section -->
                    <div id="calorie-result" style="margin-top: 40px; display: none;">
                        <div style="background: #ecf0f1; padding: 30px; border-radius: 10px;">
                            <h3 style="color: #2c3e50; margin-bottom: 20px; text-align: center;">Your Results</h3>

                            <div style="text-align: center; margin-bottom: 30px;">
                                <div style="font-size: 18px; color: #7f8c8d; margin-bottom: 10px;">Maintain Weight</div>
                                <div id="maintain-calories"
                                    style="font-size: 42px; font-weight: bold; color: #3498db; margin-bottom: 5px;">
                                </div>
                                <div style="font-size: 16px; color: #95a5a6;">Calories/day</div>
                            </div>

                            <div
                                style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-top: 30px;">
                                <div style="text-align: center; padding: 20px; background: white; border-radius: 8px;">
                                    <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 8px;">Mild Weight Loss
                                    </div>
                                    <div style="font-size: 16px; color: #95a5a6; margin-bottom: 5px;">0.25 kg/week</div>
                                    <div id="mild-loss"
                                        style="font-size: 24px; font-weight: bold; color: #f39c12; margin-bottom: 5px;">
                                    </div>
                                    <div style="font-size: 12px; color: #95a5a6;">Calories/day</div>
                                </div>

                                <div style="text-align: center; padding: 20px; background: white; border-radius: 8px;">
                                    <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 8px;">Weight Loss</div>
                                    <div style="font-size: 16px; color: #95a5a6; margin-bottom: 5px;">0.5 kg/week</div>
                                    <div id="moderate-loss"
                                        style="font-size: 24px; font-weight: bold; color: #e67e22; margin-bottom: 5px;">
                                    </div>
                                    <div style="font-size: 12px; color: #95a5a6;">Calories/day</div>
                                </div>

                                <div style="text-align: center; padding: 20px; background: white; border-radius: 8px;">
                                    <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 8px;">Extreme Weight
                                        Loss
                                    </div>
                                    <div style="font-size: 16px; color: #95a5a6; margin-bottom: 5px;">1 kg/week</div>
                                    <div id="extreme-loss"
                                        style="font-size: 24px; font-weight: bold; color: #e74c3c; margin-bottom: 5px;">
                                    </div>
                                    <div style="font-size: 12px; color: #95a5a6;">Calories/day</div>
                                </div>
                            </div>

                            <div
                                style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-top: 20px;">
                                <div style="text-align: center; padding: 20px; background: white; border-radius: 8px;">
                                    <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 8px;">Mild Weight Gain
                                    </div>
                                    <div style="font-size: 16px; color: #95a5a6; margin-bottom: 5px;">0.25 kg/week</div>
                                    <div id="mild-gain"
                                        style="font-size: 24px; font-weight: bold; color: #1abc9c; margin-bottom: 5px;">
                                    </div>
                                    <div style="font-size: 12px; color: #95a5a6;">Calories/day</div>
                                </div>

                                <div style="text-align: center; padding: 20px; background: white; border-radius: 8px;">
                                    <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 8px;">Weight Gain</div>
                                    <div style="font-size: 16px; color: #95a5a6; margin-bottom: 5px;">0.5 kg/week</div>
                                    <div id="moderate-gain"
                                        style="font-size: 24px; font-weight: bold; color: #16a085; margin-bottom: 5px;">
                                    </div>
                                    <div style="font-size: 12px; color: #95a5a6;">Calories/day</div>
                                </div>

                                <div style="text-align: center; padding: 20px; background: white; border-radius: 8px;">
                                    <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 8px;">Fast Weight Gain
                                    </div>
                                    <div style="font-size: 16px; color: #95a5a6; margin-bottom: 5px;">1 kg/week</div>
                                    <div id="extreme-gain"
                                        style="font-size: 24px; font-weight: bold; color: #27ae60; margin-bottom: 5px;">
                                    </div>
                                    <div style="font-size: 12px; color: #95a5a6;">Calories/day</div>
                                </div>
                            </div>

                            <div style="margin-top: 30px; padding: 20px; background: white; border-radius: 8px;">
                                <h4 style="color: #2c3e50; margin-bottom: 15px;">Additional Information</h4>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>BMR (Basal Metabolic Rate):</strong> <span id="bmr-value"></span>
                                    Calories/day
                                </div>
                                <div style="font-size: 14px; color: #7f8c8d; line-height: 1.6;">
                                    Your BMR is the number of calories your body burns at rest to maintain vital body
                                    functions.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Information Section -->
                    <div style="margin-top: 50px;">
                        <h3 style="color: #2c3e50; margin-bottom: 20px;">About Calorie Calculator</h3>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            The Calorie Calculator can be used to estimate the number of calories a person needs to
                            consume each day. This calculator can also provide some simple guidelines for gaining or
                            losing weight.
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">Exercise Definitions</h4>
                        <ul style="color: #7f8c8d; line-height: 1.8; margin-bottom: 20px;">
                            <li><strong>Exercise:</strong> 15-30 minutes of elevated heart rate activity.</li>
                            <li><strong>Intense exercise:</strong> 45-120 minutes of elevated heart rate activity.</li>
                            <li><strong>Very intense exercise:</strong> 2+ hours of elevated heart rate activity.</li>
                        </ul>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">BMR Estimation Formulas</h4>

                        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                            <h5 style="color: #2c3e50; margin-bottom: 10px;">Mifflin-St Jeor Equation</h5>
                            <p style="color: #7f8c8d; line-height: 1.6; margin-bottom: 10px;">
                                <strong>For men:</strong> BMR = 10W + 6.25H - 5A + 5<br>
                                <strong>For women:</strong> BMR = 10W + 6.25H - 5A - 161
                            </p>
                        </div>

                        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                            <h5 style="color: #2c3e50; margin-bottom: 10px;">Revised Harris-Benedict Equation</h5>
                            <p style="color: #7f8c8d; line-height: 1.6; margin-bottom: 10px;">
                                <strong>For men:</strong> BMR = 13.397W + 4.799H - 5.677A + 88.362<br>
                                <strong>For women:</strong> BMR = 9.247W + 3.098H - 4.330A + 447.593
                            </p>
                        </div>

                        <p style="color: #7f8c8d; line-height: 1.6; font-size: 14px;">
                            <strong>Where:</strong><br>
                            W = body weight in kg<br>
                            H = body height in cm<br>
                            A = age
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">Calorie Counting for Weight
                            Loss</h4>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            One pound of body weight is roughly equivalent to 3,500 calories. To lose 1 pound per week,
                            you need to create a calorie deficit of approximately 500 calories per day. It is generally
                            not advisable to lose more than 2 pounds per week as it can have negative health effects.
                        </p>

                        <div
                            style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; margin-top: 30px; border-radius: 5px;">
                            <h4 style="color: #856404; margin-bottom: 10px;">Important Note</h4>
                            <p style="color: #856404; margin: 0; line-height: 1.6;">
                                The results are estimates based on average values. Individual calorie needs may vary
                                based
                                on metabolism, body composition, and other factors. It is important to remember that
                                proper
                                diet and exercise is largely accepted as the best way to lose weight. Consult with a
                                healthcare professional before making significant changes to your diet or exercise
                                routine.
                            </p>
                        </div>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">Calories in Common Foods</h4>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                            <thead>
                                <tr style="background: #34495e; color: white;">
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Food</th>
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Serving Size
                                    </th>
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Calories</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td colspan="3" style="padding: 10px; border: 1px solid #ddd;">
                                        <strong>Fruits</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Apple</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 (4 oz.)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">59</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Banana</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 (6 oz.)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">151</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Orange</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 (4 oz.)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">53</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td colspan="3" style="padding: 10px; border: 1px solid #ddd;">
                                        <strong>Vegetables</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Broccoli</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 cup</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">45</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Carrots</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 cup</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">50</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Lettuce</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 cup</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">5</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td colspan="3" style="padding: 10px; border: 1px solid #ddd;">
                                        <strong>Proteins</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Chicken, cooked</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">2 oz.</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">136</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Egg</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 large</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">78</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Fish, cooked</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">2 oz.</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">136</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td colspan="3" style="padding: 10px; border: 1px solid #ddd;"><strong>Common
                                            Meals</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Bread, white</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 slice (1 oz.)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">75</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Rice</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 cup cooked</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">206</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Pizza</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">1 slice (14")</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">285</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@script
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const unitTabs = document.querySelectorAll('.unit-tab');
        const metricForm = document.getElementById('metric-form');
        const usForm = document.getElementById('us-form');
        const calorieForm = document.getElementById('calorie-form');
        const calorieResult = document.getElementById('calorie-result');
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
                calorieResult.style.display = 'none';
            });
        });

        // Calorie Calculation
        calorieForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const age = parseFloat(document.getElementById('age').value);
            const gender = document.getElementById('gender').value;
            const activity = parseFloat(document.getElementById('activity').value);
            const formula = document.getElementById('formula').value;

            if (!age || age < 15 || age > 80) {
                alert('Please enter a valid age between 15 and 80.');
                return;
            }

            let heightInCm, weightInKg;

            if (currentUnit === 'metric') {
                heightInCm = parseFloat(document.getElementById('height-cm').value);
                weightInKg = parseFloat(document.getElementById('weight-kg').value);

                if (!heightInCm || !weightInKg || heightInCm <= 0 || weightInKg <= 0) {
                    alert('Please enter valid height and weight values.');
                    return;
                }
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
                heightInCm = totalInches * 2.54;
                weightInKg = weightLbs * 0.453592;
            }

            // Calculate BMR based on selected formula
            let bmr;
            if (formula === 'mifflin') {
                // Mifflin-St Jeor Equation
                if (gender === 'male') {
                    bmr = (10 * weightInKg) + (6.25 * heightInCm) - (5 * age) + 5;
                } else {
                    bmr = (10 * weightInKg) + (6.25 * heightInCm) - (5 * age) - 161;
                }
            } else {
                // Revised Harris-Benedict Equation
                if (gender === 'male') {
                    bmr = (13.397 * weightInKg) + (4.799 * heightInCm) - (5.677 * age) + 88.362;
                } else {
                    bmr = (9.247 * weightInKg) + (3.098 * heightInCm) - (4.330 * age) + 447.593;
                }
            }

            // Calculate maintenance calories (TDEE)
            const maintenanceCalories = bmr * activity;

            // Calculate weight loss/gain calories
            // 1 kg = approximately 7700 calories
            const mildLoss = maintenanceCalories - (7700 * 0.25 / 7); // 0.25 kg/week
            const moderateLoss = maintenanceCalories - (7700 * 0.5 / 7); // 0.5 kg/week
            const extremeLoss = maintenanceCalories - (7700 * 1 / 7); // 1 kg/week

            const mildGain = maintenanceCalories + (7700 * 0.25 / 7); // 0.25 kg/week
            const moderateGain = maintenanceCalories + (7700 * 0.5 / 7); // 0.5 kg/week
            const extremeGain = maintenanceCalories + (7700 * 1 / 7); // 1 kg/week

            // Display results
            document.getElementById('bmr-value').textContent = Math.round(bmr);
            document.getElementById('maintain-calories').textContent = Math.round(maintenanceCalories);
            document.getElementById('mild-loss').textContent = Math.round(mildLoss);
            document.getElementById('moderate-loss').textContent = Math.round(moderateLoss);
            document.getElementById('extreme-loss').textContent = Math.round(extremeLoss);
            document.getElementById('mild-gain').textContent = Math.round(mildGain);
            document.getElementById('moderate-gain').textContent = Math.round(moderateGain);
            document.getElementById('extreme-gain').textContent = Math.round(extremeGain);

            // Show results
            calorieResult.style.display = 'block';

            // Smooth scroll to results
            calorieResult.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        });

        // Hover effect for calculate button
        const calculateBtn = calorieForm.querySelector('button[type="submit"]');
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
@endscript
<style>
    @media (max-width: 768px) {
        .calorie-calculator-wrapper {
            padding: 20px !important;
        }

        .unit-tab {
            padding: 8px 20px !important;
            font-size: 14px !important;
        }

        .form-row {
            display: block !important;
        }

        .form-row>div {
            width: 100% !important;
            margin-bottom: 15px;
        }

        #calorie-result>div>div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }

        table {
            font-size: 14px;
        }

        table th,
        table td {
            padding: 8px !important;
        }
    }
</style>
