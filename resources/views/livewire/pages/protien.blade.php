@include('livewire.includes.page-hero')

<section class="service-details p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                @include('livewire.includes.left-menu')
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">

                <div class="protein-calculator-wrapper">
                    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">{{ gt('protein_calculator', 'Protein Calculator') }}</h2>
                    <p style="text-align: center; color: #7f8c8d; margin-bottom: 30px; line-height: 1.6;">
                        {{ gt('protein_calculator_description', 'The Protein Calculator estimates the daily amount of dietary protein adults require to remain healthy. Modify the values and click the calculate button to use.') }}
                    </p>

                    <!-- Unit Selection Tabs -->
                    <div class="unit-tabs" style="margin-bottom: 30px; text-align: center;">
                        <button type="button" class="unit-tab" data-unit="us"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: white; color: #3498db; border-radius: 5px; cursor: pointer; font-size: 16px;">{{ gt('us_units', 'US Units') }}</button>
                        <button type="button" class="unit-tab active" data-unit="metric"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: #3498db; color: white; border-radius: 5px; cursor: pointer; font-size: 16px;">{{ gt('metric_units', 'Metric Units') }}</button>
                    </div>

                    <!-- Protein Form -->
                    <form id="protein-form">
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('age', 'Age') }}</label>
                                <input type="number" id="age" class="form-control" placeholder="18-80" min="18" max="80"
                                    value="30"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                            </div>
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('gender', 'Gender') }}</label>
                                <select id="gender" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="male">{{ gt('male', 'Male') }}</option>
                                    <option value="female">{{ gt('female', 'Female') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- US Units Form -->
                        <div id="us-form" class="unit-form" style="display: none;">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('height', 'Height') }}</label>
                                    <div style="display: flex; gap: 10px;">
                                        <input type="number" id="height-ft" class="form-control" placeholder="{{ gt('feet', 'Feet') }}"
                                            min="0" value="5"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                        <input type="number" id="height-in" class="form-control" placeholder="{{ gt('inches', 'Inches') }}"
                                            min="0" max="11" step="1" value="10"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('weight_lbs', 'Weight (lbs)') }}</label>
                                    <input type="number" id="weight-lbs" class="form-control"
                                        placeholder="{{ gt('weight_lbs_placeholder', 'Weight in pounds') }}" step="0.1" value="165"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                            </div>
                        </div>

                        <!-- Metric Units Form -->
                        <div id="metric-form" class="unit-form">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('height_cm', 'Height (cm)') }}</label>
                                    <input type="number" id="height-cm" class="form-control" placeholder="{{ gt('height_cm_placeholder', 'Height in cm') }}"
                                        step="1" value="178"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                                <div class="col-md-6" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('weight_kg', 'Weight (kg)') }}</label>
                                    <input type="number" id="weight-kg" class="form-control" placeholder="{{ gt('weight_kg_placeholder', 'Weight in kg') }}"
                                        step="0.1" value="75"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                            </div>
                        </div>

                        <!-- Activity Level -->
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-12" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('activity_level', 'Activity Level') }}</label>
                                <select id="activity" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="1.2">{{ gt('sedentary', 'Sedentary: little or no exercise') }}</option>
                                    <option value="1.375">{{ gt('light_activity', 'Light: exercise 1-3 times/week') }}</option>
                                    <option value="1.55" selected>{{ gt('moderate_activity', 'Moderate: exercise 4-5 times/week') }}</option>
                                    <option value="1.725">{{ gt('active', 'Active: daily exercise or intense exercise 3-4 times/week') }}
                                    </option>
                                    <option value="1.9">{{ gt('very_active', 'Very Active: intense exercise 6-7 times/week') }}</option>
                                    <option value="2.0">{{ gt('extra_active', 'Extra Active: very intense exercise daily, or physical job') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Goal Selection -->
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-12" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('goal', 'Goal') }}</label>
                                <select id="goal" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="maintain">{{ gt('maintain_weight', 'Maintain Weight') }}</option>
                                    <option value="lose">{{ gt('lose_weight', 'Lose Weight') }}</option>
                                    <option value="gain">{{ gt('gain_muscle', 'Gain Muscle') }}</option>
                                </select>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 30px;">
                            <button type="submit"
                                style="padding: 15px 60px; background: #27ae60; color: white; border: none; border-radius: 5px; font-size: 18px; font-weight: 600; cursor: pointer; transition: all 0.3s;">{{ gt('calculate_protein', 'Calculate Protein') }}</button>
                        </div>
                    </form>

                    <!-- Results Section -->
                    <div id="protein-result" style="margin-top: 40px; display: none;">
                        <div style="background: #ecf0f1; padding: 30px; border-radius: 10px;">
                            <h3 style="color: #2c3e50; margin-bottom: 20px; text-align: center;">{{ gt('daily_protein_requirements', 'Your Daily Protein Requirements') }}</h3>

                            <div style="text-align: center; margin-bottom: 30px;">
                                <div id="protein-value"
                                    style="font-size: 48px; font-weight: bold; color: #3498db; margin-bottom: 10px;">
                                </div>
                                <div style="font-size: 18px; color: #7f8c8d;">{{ gt('grams_protein_per_day', 'grams of protein per day') }}</div>
                            </div>

                            <!-- Protein Range -->
                            <div
                                style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                <h4 style="color: #2c3e50; margin-bottom: 15px; font-size: 18px;">{{ gt('recommended_range', 'Recommended Range') }}
                                </h4>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                    <div style="text-align: center; flex: 1;">
                                        <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 5px;">{{ gt('minimum', 'Minimum') }}</div>
                                        <div id="protein-min"
                                            style="font-size: 24px; font-weight: 600; color: #e74c3c;">
                                        </div>
                                    </div>
                                    <div style="text-align: center; flex: 1;">
                                        <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 5px;">{{ gt('recommended', 'Recommended') }}
                                        </div>
                                        <div id="protein-recommended"
                                            style="font-size: 24px; font-weight: 600; color: #27ae60;"></div>
                                    </div>
                                    <div style="text-align: center; flex: 1;">
                                        <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 5px;">{{ gt('maximum', 'Maximum') }}</div>
                                        <div id="protein-max"
                                            style="font-size: 24px; font-weight: 600; color: #f39c12;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Info -->
                            <div
                                style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                <h4 style="color: #2c3e50; margin-bottom: 15px; font-size: 18px;">{{ gt('additional_information', 'Additional Information') }}
                                </h4>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('your_bmr', 'Your BMR') }}:</strong> <span id="bmr-value"></span> {{ gt('calories_per_day', 'calories/day') }}
                                </div>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('daily_calorie_needs', 'Daily Calorie Needs') }}:</strong> <span id="tdee-value"></span> {{ gt('calories_per_day', 'calories/day') }}
                                </div>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('protein_per_kg_body_weight', 'Protein per kg body weight') }}:</strong> <span id="protein-per-kg"></span> g/kg
                                </div>
                                <div style="font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('protein_calories', 'Protein calories') }}:</strong> <span id="protein-calories"></span> {{ gt('calories_per_day', 'calories/day') }}
                                    (<span id="protein-percentage"></span>% {{ gt('of_daily_intake', 'of daily intake') }})
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Protein Information -->
                    <div style="margin-top: 50px;">
                        <h3 style="color: #2c3e50; margin-bottom: 20px;">{{ gt('what_are_proteins', 'What are Proteins?') }}</h3>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('proteins_description_1', 'Proteins are one of three primary macronutrients that provide energy to the human body, along with fats and carbohydrates. Proteins are also responsible for a large portion of the work that is done in cells; they are necessary for proper structure and function of tissues and organs, and also act to regulate them.') }}
                        </p>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('proteins_description_2', 'They are comprised of a number of amino acids that are essential to proper body function, and serve as the building blocks of body tissue. There are 20 different amino acids in total, and the sequence of amino acids determines a protein\'s structure and function.') }}
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">{{ gt('how_much_protein_need', 'How Much Protein Do I Need?') }}
                        </h4>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('protein_requirements_description', 'The amount of protein that the human body requires daily is dependent on many conditions, including overall energy intake, growth of the individual, and physical activity level. The recommended range of protein intake is between 0.8 g/kg and 1.8 g/kg of body weight, dependent on activity level and goals.') }}
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">{{ gt('recommended_dietary_allowance', 'Recommended Dietary Allowance (RDA)') }}</h4>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                            <thead>
                                <tr style="background: #34495e; color: white;">
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">{{ gt('age_group', 'Age Group') }}</th>
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">{{ gt('protein_needed_grams_day', 'Protein Needed (grams/day)') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Age 1-3</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">13</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Age 4-8</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">19</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Age 9-13</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">34</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Age 14-18 (Girls)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">46</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Age 14-18 (Boys)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">52</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Age 19-70+ (Women)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">46</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Age 19-70+ (Men)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">56</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">{{ gt('foods_high_in_protein', 'Foods High in Protein') }}</h4>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('protein_foods_description', 'There are many different combinations of food that a person can eat to meet their protein intake requirements. For many people, a large portion of protein intake comes from meat and dairy, though it is possible to get enough protein while meeting certain dietary restrictions.') }}
                        </p>

                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                            <thead>
                                <tr style="background: #34495e; color: white;">
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">{{ gt('food', 'Food') }}</th>
                                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">{{ gt('protein_amount', 'Protein Amount') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Egg (1 large/50g)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">6 g</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Milk (1 cup/8 oz)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">8 g</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Meat (1 slice/2 oz)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">14 g</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Seafood (2 oz)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">16 g</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Chicken Breast (3 oz)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">26 g</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Greek Yogurt (1 cup)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">17 g</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Dry Beans (1 cup/92g)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">16 g</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Nuts (1 cup/92g)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">20 g</td>
                                </tr>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd;">Tofu (1 cup)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">20 g</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">Quinoa (1 cup cooked)</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">8 g</td>
                                </tr>
                            </tbody>
                        </table>

                        <div
                            style="background: #d1ecf1; border-left: 4px solid #17a2b8; padding: 20px; margin-top: 30px; border-radius: 5px;">
                            <h4 style="color: #0c5460; margin-bottom: 10px;">{{ gt('important_note', 'Important Note') }}</h4>
                            <p style="color: #0c5460; margin: 0; line-height: 1.6;">
                                {{ gt('protein_calculator_disclaimer', 'People who are highly active, or who wish to build more muscle should generally consume more protein. Some sources suggest consuming between 1.8 to 2 g/kg for those who are highly active. Each individual should consult a specialist, be it a dietitian, doctor, or personal trainer, to help determine their individual needs.') }}
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
        const proteinForm = document.getElementById('protein-form');
        const proteinResult = document.getElementById('protein-result');
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
                proteinResult.style.display = 'none';
            });
        });

        // Protein Calculation
        proteinForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const age = parseInt(document.getElementById('age').value);
            const gender = document.getElementById('gender').value;
            const activityLevel = parseFloat(document.getElementById('activity').value);
            const goal = document.getElementById('goal').value;

            let heightInCm, weightInKg;

            if (currentUnit === 'metric') {
                heightInCm = parseFloat(document.getElementById('height-cm').value);
                weightInKg = parseFloat(document.getElementById('weight-kg').value);

                if (!heightInCm || !weightInKg || heightInCm <= 0 || weightInKg <= 0) {
                    alert('{{ gt("invalid_height_weight", "Please enter valid height and weight values.") }}');
                    return;
                }
            } else {
                const heightFt = parseFloat(document.getElementById('height-ft').value) || 0;
                const heightIn = parseFloat(document.getElementById('height-in').value) || 0;
                const weightLbs = parseFloat(document.getElementById('weight-lbs').value);

                if ((heightFt === 0 && heightIn === 0) || !weightLbs || weightLbs <= 0) {
                    alert('{{ gt("invalid_height_weight", "Please enter valid height and weight values.") }}');
                    return;
                }

                // Convert to metric
                const totalInches = (heightFt * 12) + heightIn;
                heightInCm = totalInches * 2.54;
                weightInKg = weightLbs * 0.453592;
            }

            // Calculate BMR using Mifflin-St Jeor Equation
            let bmr;
            if (gender === 'male') {
                bmr = (10 * weightInKg) + (6.25 * heightInCm) - (5 * age) + 5;
            } else {
                bmr = (10 * weightInKg) + (6.25 * heightInCm) - (5 * age) - 161;
            }

            // Calculate TDEE (Total Daily Energy Expenditure)
            const tdee = bmr * activityLevel;

            // Calculate protein requirements based on goal
            let proteinPerKg;
            let proteinMin, proteinMax, proteinRecommended;

            switch (goal) {
                case 'lose':
                    // Higher protein for weight loss (1.6-2.2 g/kg)
                    proteinPerKg = 1.8;
                    proteinMin = weightInKg * 1.6;
                    proteinMax = weightInKg * 2.2;
                    proteinRecommended = weightInKg * 1.8;
                    break;
                case 'gain':
                    // Higher protein for muscle gain (1.6-2.2 g/kg)
                    proteinPerKg = 2.0;
                    proteinMin = weightInKg * 1.6;
                    proteinMax = weightInKg * 2.2;
                    proteinRecommended = weightInKg * 2.0;
                    break;
                default:
                    // Maintenance (1.2-1.6 g/kg)
                    proteinPerKg = 1.4;
                    proteinMin = weightInKg * 0.8;
                    proteinMax = weightInKg * 1.8;
                    proteinRecommended = weightInKg * 1.4;
            }

            // Calculate protein calories (1g protein = 4 calories)
            const proteinCalories = proteinRecommended * 4;
            const proteinPercentage = (proteinCalories / tdee) * 100;

            // Display results
            document.getElementById('protein-value').textContent = Math.round(proteinRecommended);
            document.getElementById('protein-min').textContent = Math.round(proteinMin) + 'g';
            document.getElementById('protein-recommended').textContent = Math.round(proteinRecommended) + 'g';
            document.getElementById('protein-max').textContent = Math.round(proteinMax) + 'g';
            document.getElementById('bmr-value').textContent = Math.round(bmr);
            document.getElementById('tdee-value').textContent = Math.round(tdee);
            document.getElementById('protein-per-kg').textContent = proteinPerKg.toFixed(1);
            document.getElementById('protein-calories').textContent = Math.round(proteinCalories);
            document.getElementById('protein-percentage').textContent = proteinPercentage.toFixed(1);

            // Show results
            proteinResult.style.display = 'block';

            // Smooth scroll to results
            proteinResult.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        });

        // Hover effect for calculate button
        const calculateBtn = proteinForm.querySelector('button[type="submit"]');
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

<style>
    @media (max-width: 768px) {
        .protein-calculator-wrapper {
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

        table {
            font-size: 14px;
        }

        table th,
        table td {
            padding: 8px !important;
        }

        #protein-result>div>div[style*="display: flex"] {
            flex-direction: column !important;
        }

        #protein-result>div>div[style*="display: flex"]>div {
            margin-bottom: 15px;
        }
    }
</style>
