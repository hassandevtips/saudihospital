@include('livewire.includes.page-hero')

<section class="service-details p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                @include('livewire.includes.left-menu')
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">

                <div class="ideal-weight-calculator-wrapper">
                    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">{{ gt('ideal_weight_calculator', 'Ideal Weight Calculator') }}</h2>

                    <!-- Unit Selection Tabs -->
                    <div class="unit-tabs" style="margin-bottom: 30px; text-align: center;">
                        <button type="button" class="unit-tab active" data-unit="metric"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: #3498db; color: white; border-radius: 5px; cursor: pointer; font-size: 16px;">{{ gt('metric_units', 'Metric Units') }}</button>
                        <button type="button" class="unit-tab" data-unit="us"
                            style="padding: 10px 30px; margin: 0 5px; border: 2px solid #3498db; background: white; color: #3498db; border-radius: 5px; cursor: pointer; font-size: 16px;">{{ gt('us_units', 'US Units') }}</button>
                    </div>

                    <!-- Ideal Weight Form -->
                    <form id="ideal-weight-form">
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('age', 'Age') }}</label>
                                <input type="number" id="age" class="form-control" placeholder="{{ gt('age_2_80', 'Age (2-80)') }}" min="2"
                                    max="80"
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

                        <!-- Metric Units Form -->
                        <div id="metric-form" class="unit-form">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-12" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('height_cm', 'Height (cm)') }}</label>
                                    <input type="number" id="height-cm" class="form-control" placeholder="{{ gt('height_cm_placeholder', 'Height in cm') }}"
                                        step="0.1"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                </div>
                            </div>
                        </div>

                        <!-- US Units Form -->
                        <div id="us-form" class="unit-form" style="display: none;">
                            <div class="form-row" style="margin-bottom: 20px;">
                                <div class="col-md-12" style="padding: 0 10px;">
                                    <label
                                        style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('height', 'Height') }}</label>
                                    <div style="display: flex; gap: 10px;">
                                        <input type="number" id="height-ft" class="form-control" placeholder="{{ gt('feet', 'Feet') }}"
                                            min="0"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                        <input type="number" id="height-in" class="form-control" placeholder="{{ gt('inches', 'Inches') }}"
                                            min="0" max="11" step="0.1"
                                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 30px;">
                            <button type="submit"
                                style="padding: 15px 60px; background: #27ae60; color: white; border: none; border-radius: 5px; font-size: 18px; font-weight: 600; cursor: pointer; transition: all 0.3s;">{{ gt('calculate', 'Calculate') }}</button>
                        </div>
                    </form>

                    <!-- Results Section -->
                    <div id="ideal-weight-result" style="margin-top: 40px; display: none;">
                        <div style="background: #ecf0f1; padding: 30px; border-radius: 10px;">
                            <h3 style="color: #2c3e50; margin-bottom: 20px; text-align: center;">{{ gt('result', 'Result') }}</h3>
                            <p style="text-align: center; color: #7f8c8d; margin-bottom: 30px;">{{ gt('ideal_weight_based_on_formulas', 'The ideal weight based on popular formulas:') }}</p>

                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <thead>
                                    <tr style="background: #34495e; color: white;">
                                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">{{ gt('formula', 'Formula') }}
                                        </th>
                                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">{{ gt('ideal_weight', 'Ideal Weight') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="results-table-body">
                                    <!-- Results will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Information Section -->
                    <div style="margin-top: 50px;">
                        <h3 style="color: #2c3e50; margin-bottom: 20px;">{{ gt('how_much_should_i_weigh', 'How Much Should I Weigh?') }}</h3>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('ideal_weight_description', 'Most everyone has at some point tried to lose weight, or at least known somebody who has. This is largely due to the perception of an "ideal" body weight, which is often based on what we see promoted through various media such as social media, TV, movies, magazines, etc. Although ideal body weight (IBW) today is sometimes based on perceived visual appeal, IBW was actually introduced to estimate dosages for medical use, and the formulas that calculate it are not at all related to how a person looks at a given weight.') }}
                        </p>

                        <div
                            style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; margin-top: 30px; border-radius: 5px;">
                            <h4 style="color: #856404; margin-bottom: 10px;">{{ gt('important_note', 'Important Note') }}</h4>
                            <p style="color: #856404; margin: 0; line-height: 1.6;">
                                {{ gt('ideal_weight_disclaimer', 'IBW is not a perfect measurement. It does not consider the percentages of body fat and muscle in a person\'s body. This means that it is possible for highly fit, healthy athletes to be considered overweight based on their IBW. This is why IBW should be considered with the perspective that it is an imperfect measure and not necessarily indicative of health.') }}
                            </p>
                        </div>

                        <h3 style="color: #2c3e50; margin-top: 40px; margin-bottom: 20px;">{{ gt('formulas_finding_ideal_weight', 'Formulas for Finding the Ideal Weight') }}</h3>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('ibw_formulas_description', 'IBW formulas were developed mainly to facilitate drug dosage calculations. All of the formulas have the same format of a base weight given a height of 5 feet with a set weight increment added per inch over the height of 5 feet.') }}
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">G. J. Hamwi Formula (1964)
                        </h4>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Male:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">48.0 kg + 2.7 kg per inch over 5
                                        feet</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Female:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">45.5 kg + 2.2 kg per inch over 5
                                        feet</td>
                                </tr>
                            </tbody>
                        </table>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px; font-style: italic;">Invented
                            for medicinal dosage purposes.</p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">B. J. Devine Formula (1974)
                        </h4>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Male:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">50.0 kg + 2.3 kg per inch over 5
                                        feet</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Female:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">45.5 kg + 2.3 kg per inch over 5
                                        feet</td>
                                </tr>
                            </tbody>
                        </table>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px; font-style: italic;">Similar to
                            the Hamwi Formula, it was originally intended as a basis for medicinal dosages based on
                            weight
                            and height.</p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">J. D. Robinson Formula (1983)
                        </h4>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Male:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">52 kg + 1.9 kg per inch over 5
                                        feet
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Female:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">49 kg + 1.7 kg per inch over 5
                                        feet
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px; font-style: italic;">
                            Modification
                            of the Devine Formula.</p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">D. R. Miller Formula (1983)
                        </h4>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tbody>
                                <tr style="background: #ecf0f1;">
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Male:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">56.2 kg + 1.41 kg per inch over 5
                                        feet</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Female:</td>
                                    <td style="padding: 10px; border: 1px solid #ddd;">53.1 kg + 1.36 kg per inch over 5
                                        feet</td>
                                </tr>
                            </tbody>
                        </table>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px; font-style: italic;">
                            Modification
                            of the Devine Formula.</p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">{{ gt('healthy_bmi_range', 'Healthy BMI Range') }}</h4>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('healthy_bmi_range_description', 'The World Health Organization\'s (WHO) recommended healthy BMI range is 18.5 - 25 for both males and females. Based on the BMI range, it is possible to find out a healthy weight for any given height.') }}
                        </p>
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
        const idealWeightForm = document.getElementById('ideal-weight-form');
        const idealWeightResult = document.getElementById('ideal-weight-result');
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
                idealWeightResult.style.display = 'none';
            });
        });

        // Ideal Weight Calculation
        idealWeightForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const age = parseInt(document.getElementById('age').value);
            const gender = document.getElementById('gender').value;
            let heightInInches, heightInCm;

            if (currentUnit === 'metric') {
                heightInCm = parseFloat(document.getElementById('height-cm').value);

                if (!heightInCm || heightInCm <= 0) {
                    alert('{{ gt("invalid_height_value", "Please enter a valid height value.") }}');
                    return;
                }

                // Convert cm to inches for formula calculations
                heightInInches = heightInCm / 2.54;
            } else {
                const heightFt = parseFloat(document.getElementById('height-ft').value) || 0;
                const heightIn = parseFloat(document.getElementById('height-in').value) || 0;

                if (heightFt === 0 && heightIn === 0) {
                    alert('{{ gt("invalid_height_value", "Please enter a valid height value.") }}');
                    return;
                }

                heightInInches = (heightFt * 12) + heightIn;
                heightInCm = heightInInches * 2.54;
            }

            // Calculate height in meters for BMI calculations
            const heightInMeters = heightInCm / 100;

            // Calculate inches over 5 feet (60 inches)
            const inchesOver5Feet = heightInInches - 60;

            let results = {};

            // Robinson Formula (1983)
            if (gender === 'male') {
                results.robinson = 52 + (1.9 * inchesOver5Feet);
            } else {
                results.robinson = 49 + (1.7 * inchesOver5Feet);
            }

            // Miller Formula (1983)
            if (gender === 'male') {
                results.miller = 56.2 + (1.41 * inchesOver5Feet);
            } else {
                results.miller = 53.1 + (1.36 * inchesOver5Feet);
            }

            // Devine Formula (1974)
            if (gender === 'male') {
                results.devine = 50.0 + (2.3 * inchesOver5Feet);
            } else {
                results.devine = 45.5 + (2.3 * inchesOver5Feet);
            }

            // Hamwi Formula (1964)
            if (gender === 'male') {
                results.hamwi = 48.0 + (2.7 * inchesOver5Feet);
            } else {
                results.hamwi = 45.5 + (2.2 * inchesOver5Feet);
            }

            // Healthy BMI Range (18.5 - 25)
            const minHealthyWeight = 18.5 * (heightInMeters * heightInMeters);
            const maxHealthyWeight = 25 * (heightInMeters * heightInMeters);

            // Display results
            const resultsTableBody = document.getElementById('results-table-body');
            resultsTableBody.innerHTML = '';

            const formulas = [{
                    name: 'Robinson (1983)',
                    value: results.robinson
                },
                {
                    name: 'Miller (1983)',
                    value: results.miller
                },
                {
                    name: 'Devine (1974)',
                    value: results.devine
                },
                {
                    name: 'Hamwi (1964)',
                    value: results.hamwi
                }
            ];

            formulas.forEach((formula, index) => {
                const row = document.createElement('tr');
                row.style.background = index % 2 === 0 ? '#ecf0f1' : 'white';

                let weightText;
                if (currentUnit === 'metric') {
                    weightText = `${formula.value.toFixed(1)} kg`;
                } else {
                    const weightLbs = formula.value * 2.20462;
                    weightText = `${weightLbs.toFixed(1)} lbs`;
                }

                row.innerHTML = `
                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">${formula.name}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; font-size: 18px; color: #3498db;"><strong>${weightText}</strong></td>
                `;
                resultsTableBody.appendChild(row);
            });

            // Add BMI Range row
            const bmiRow = document.createElement('tr');
            bmiRow.style.background = 'white';

            let bmiRangeText;
            if (currentUnit === 'metric') {
                bmiRangeText = `${minHealthyWeight.toFixed(1)} - ${maxHealthyWeight.toFixed(1)} kg`;
            } else {
                const minLbs = minHealthyWeight * 2.20462;
                const maxLbs = maxHealthyWeight * 2.20462;
                bmiRangeText = `${minLbs.toFixed(1)} - ${maxLbs.toFixed(1)} lbs`;
            }

            bmiRow.innerHTML = `
                <td style="padding: 10px; border: 1px solid #ddd; font-weight: 600;">Healthy BMI Range</td>
                <td style="padding: 10px; border: 1px solid #ddd; font-size: 18px; color: #27ae60;"><strong>${bmiRangeText}</strong></td>
            `;
            resultsTableBody.appendChild(bmiRow);

            // Show results
            idealWeightResult.style.display = 'block';

            // Smooth scroll to results
            idealWeightResult.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        });

        // Hover effect for calculate button
        const calculateBtn = idealWeightForm.querySelector('button[type="submit"]');
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
        .ideal-weight-calculator-wrapper {
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
    }
</style>
