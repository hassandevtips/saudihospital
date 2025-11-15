<div class="pregnancy-calculator-wrapper">
    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">Pregnancy Calculator</h2>

    <p style="text-align: center; color: #7f8c8d; margin-bottom: 30px; line-height: 1.6;">
        The Pregnancy Calculator can estimate a pregnancy schedule based on the provided due date, last period date,
        ultrasound date, conception date, or IVF transfer date.
    </p>

    <!-- Calculation Method Tabs -->
    <div class="calculation-tabs"
        style="margin-bottom: 30px; text-align: center; flex-wrap: wrap; display: flex; justify-content: center; gap: 10px;">
        <button type="button" class="calc-tab active" data-method="last-period"
            style="padding: 10px 20px; border: 2px solid #e91e63; background: #e91e63; color: white; border-radius: 5px; cursor: pointer; font-size: 14px; transition: all 0.3s;">Last
            Period</button>
        <button type="button" class="calc-tab" data-method="due-date"
            style="padding: 10px 20px; border: 2px solid #e91e63; background: white; color: #e91e63; border-radius: 5px; cursor: pointer; font-size: 14px; transition: all 0.3s;">Due
            Date</button>
        <button type="button" class="calc-tab" data-method="ultrasound"
            style="padding: 10px 20px; border: 2px solid #e91e63; background: white; color: #e91e63; border-radius: 5px; cursor: pointer; font-size: 14px; transition: all 0.3s;">Ultrasound</button>
        <button type="button" class="calc-tab" data-method="conception"
            style="padding: 10px 20px; border: 2px solid #e91e63; background: white; color: #e91e63; border-radius: 5px; cursor: pointer; font-size: 14px; transition: all 0.3s;">Conception
            Date</button>
        <button type="button" class="calc-tab" data-method="ivf"
            style="padding: 10px 20px; border: 2px solid #e91e63; background: white; color: #e91e63; border-radius: 5px; cursor: pointer; font-size: 14px; transition: all 0.3s;">IVF
            Transfer</button>
    </div>

    <!-- Pregnancy Form -->
    <form id="pregnancy-form">
        <!-- Last Period Method -->
        <div id="last-period-form" class="calc-method-form">
            <div class="form-row" style="margin-bottom: 20px;">
                <div class="col-md-6" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">First Day of
                        Last Period</label>
                    <input type="date" id="last-period-date" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                </div>
                <div class="col-md-6" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Average Cycle
                        Length</label>
                    <select id="cycle-length" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                        <option value="22">22 days</option>
                        <option value="23">23 days</option>
                        <option value="24">24 days</option>
                        <option value="25">25 days</option>
                        <option value="26">26 days</option>
                        <option value="27">27 days</option>
                        <option value="28" selected>28 days</option>
                        <option value="29">29 days</option>
                        <option value="30">30 days</option>
                        <option value="31">31 days</option>
                        <option value="32">32 days</option>
                        <option value="33">33 days</option>
                        <option value="34">34 days</option>
                        <option value="35">35 days</option>
                        <option value="36">36 days</option>
                        <option value="37">37 days</option>
                        <option value="38">38 days</option>
                        <option value="39">39 days</option>
                        <option value="40">40 days</option>
                        <option value="41">41 days</option>
                        <option value="42">42 days</option>
                        <option value="43">43 days</option>
                        <option value="44">44 days</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Due Date Method -->
        <div id="due-date-form" class="calc-method-form" style="display: none;">
            <div class="form-row" style="margin-bottom: 20px;">
                <div class="col-md-12" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Your Due
                        Date</label>
                    <input type="date" id="due-date" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                </div>
            </div>
        </div>

        <!-- Ultrasound Method -->
        <div id="ultrasound-form" class="calc-method-form" style="display: none;">
            <div class="form-row" style="margin-bottom: 20px;">
                <div class="col-md-6" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Ultrasound
                        Date</label>
                    <input type="date" id="ultrasound-date" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                </div>
                <div class="col-md-6" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Length of
                        Pregnancy at Time</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="number" id="ultrasound-weeks" class="form-control" placeholder="Weeks" min="0"
                            max="42"
                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                        <input type="number" id="ultrasound-days" class="form-control" placeholder="Days" min="0"
                            max="6"
                            style="width: 48%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Conception Date Method -->
        <div id="conception-form" class="calc-method-form" style="display: none;">
            <div class="form-row" style="margin-bottom: 20px;">
                <div class="col-md-12" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Conception
                        Date</label>
                    <input type="date" id="conception-date" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                </div>
            </div>
        </div>

        <!-- IVF Transfer Method -->
        <div id="ivf-form" class="calc-method-form" style="display: none;">
            <div class="form-row" style="margin-bottom: 20px;">
                <div class="col-md-6" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Transfer
                        Date</label>
                    <input type="date" id="ivf-transfer-date" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                </div>
                <div class="col-md-6" style="padding: 0 10px; margin-bottom: 15px;">
                    <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">Embryo
                        Age</label>
                    <select id="embryo-age" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                        <option value="3">Day 3</option>
                        <option value="5" selected>Day 5</option>
                        <option value="6">Day 6</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <button type="submit"
                style="padding: 15px 60px; background: #e91e63; color: white; border: none; border-radius: 5px; font-size: 18px; font-weight: 600; cursor: pointer; transition: all 0.3s;">Calculate</button>
        </div>
    </form>

    <!-- Results Section -->
    <div id="pregnancy-result" style="margin-top: 40px; display: none;">
        <div style="background: #fce4ec; padding: 30px; border-radius: 10px;">
            <h3 style="color: #2c3e50; margin-bottom: 20px; text-align: center;">Your Pregnancy Timeline</h3>

            <!-- Key Dates -->
            <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div>
                        <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 5px;">Due Date</div>
                        <div id="result-due-date" style="font-size: 18px; font-weight: 600; color: #e91e63;"></div>
                    </div>
                    <div>
                        <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 5px;">Current Week</div>
                        <div id="result-current-week" style="font-size: 18px; font-weight: 600; color: #e91e63;"></div>
                    </div>
                    <div>
                        <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 5px;">Days to Go</div>
                        <div id="result-days-to-go" style="font-size: 18px; font-weight: 600; color: #e91e63;"></div>
                    </div>
                    <div>
                        <div style="font-size: 14px; color: #7f8c8d; margin-bottom: 5px;">Conception Date</div>
                        <div id="result-conception-date" style="font-size: 18px; font-weight: 600; color: #e91e63;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div style="margin: 30px 0;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span style="font-size: 14px; color: #2c3e50; font-weight: 600;">Pregnancy Progress</span>
                    <span id="progress-percentage" style="font-size: 14px; color: #e91e63; font-weight: 600;"></span>
                </div>
                <div
                    style="width: 100%; height: 30px; background: #f0f0f0; border-radius: 15px; overflow: hidden; position: relative;">
                    <div id="progress-bar"
                        style="height: 100%; background: linear-gradient(to right, #e91e63, #f06292); border-radius: 15px; transition: width 0.5s ease; display: flex; align-items: center; justify-content: flex-end; padding-right: 10px;">
                    </div>
                </div>
            </div>

            <!-- Trimester Information -->
            <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="color: #2c3e50; margin-bottom: 15px;">Current Trimester</h4>
                <div id="trimester-info" style="color: #34495e; line-height: 1.8;"></div>
            </div>

            <!-- Important Milestones -->
            <div style="background: white; padding: 20px; border-radius: 8px;">
                <h4 style="color: #2c3e50; margin-bottom: 15px;">Important Milestones</h4>
                <div id="milestones-list" style="color: #34495e;"></div>
            </div>
        </div>
    </div>

    <!-- Information Section -->
    <div style="margin-top: 50px;">
        <h3 style="color: #2c3e50; margin-bottom: 20px;">About Pregnancy Term & Due Date</h3>
        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
            Pregnancy is a term used to describe a woman's state over a time period (~9 months) during which one or
            more offspring develops inside of a woman. Childbirth usually occurs approximately 38 weeks after
            conception, or about 40 weeks after the last menstrual period.
        </p>
        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
            The World Health Organization defines a normal pregnancy term to last between 37 and 42 weeks. During a
            person's first OB-GYN visit, the doctor will usually provide an estimated date (based on a sonogram) at
            which the child will be born, or due date.
        </p>

        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">Pregnancy Trimesters</h4>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
            <thead>
                <tr style="background: #e91e63; color: white;">
                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Trimester</th>
                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Weeks</th>
                    <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background: #fce4ec;">
                    <td style="padding: 10px; border: 1px solid #ddd;"><strong>First Trimester</strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Week 1 - Week 12</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Initial development of organs and body systems
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;"><strong>Second Trimester</strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Week 13 - Week 26</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Rapid growth and development</td>
                </tr>
                <tr style="background: #fce4ec;">
                    <td style="padding: 10px; border: 1px solid #ddd;"><strong>Third Trimester</strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Week 27 - Birth</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Final development and preparation for birth</td>
                </tr>
            </tbody>
        </table>

        <div
            style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; margin-top: 30px; border-radius: 5px;">
            <h4 style="color: #856404; margin-bottom: 10px;">Important Note</h4>
            <p style="color: #856404; margin: 0; line-height: 1.6;">
                While the due date can be estimated, the actual length of pregnancy depends on various factors,
                including age, length of previous pregnancies, and weight of the mother at birth. Studies have shown
                that fewer than 4% of births occur on the exact due date, 60% occur within a week of the due date, and
                almost 90% occur within two weeks of the due date. Always consult with your healthcare provider for
                personalized medical advice.
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calcTabs = document.querySelectorAll('.calc-tab');
        const pregnancyForm = document.getElementById('pregnancy-form');
        const pregnancyResult = document.getElementById('pregnancy-result');
        let currentMethod = 'last-period';

        // Set today's date as default for date inputs
        const today = new Date().toISOString().split('T')[0];

        // Method tab switching
        calcTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                calcTabs.forEach(t => {
                    t.style.background = 'white';
                    t.style.color = '#e91e63';
                });
                this.style.background = '#e91e63';
                this.style.color = 'white';

                currentMethod = this.dataset.method;

                // Hide all forms
                document.querySelectorAll('.calc-method-form').forEach(form => {
                    form.style.display = 'none';
                });

                // Show selected form
                document.getElementById(currentMethod + '-form').style.display = 'block';
                pregnancyResult.style.display = 'none';
            });
        });

        // Pregnancy Calculation
        pregnancyForm.addEventListener('submit', function(e) {
            e.preventDefault();

            let dueDate;

            if (currentMethod === 'last-period') {
                const lastPeriodDate = document.getElementById('last-period-date').value;
                const cycleLength = parseInt(document.getElementById('cycle-length').value);

                if (!lastPeriodDate) {
                    alert('Please enter the first day of your last period.');
                    return;
                }

                // Calculate due date: LMP + 280 days (adjusted for cycle length)
                const lmp = new Date(lastPeriodDate);
                const adjustment = cycleLength - 28;
                dueDate = new Date(lmp.getTime() + (280 + adjustment) * 24 * 60 * 60 * 1000);

            } else if (currentMethod === 'due-date') {
                const dueDateInput = document.getElementById('due-date').value;

                if (!dueDateInput) {
                    alert('Please enter your due date.');
                    return;
                }

                dueDate = new Date(dueDateInput);

            } else if (currentMethod === 'ultrasound') {
                const ultrasoundDate = document.getElementById('ultrasound-date').value;
                const weeks = parseInt(document.getElementById('ultrasound-weeks').value) || 0;
                const days = parseInt(document.getElementById('ultrasound-days').value) || 0;

                if (!ultrasoundDate || (weeks === 0 && days === 0)) {
                    alert('Please enter ultrasound date and pregnancy length.');
                    return;
                }

                // Calculate due date: ultrasound date + (280 - (weeks*7 + days)) days
                const ultrasound = new Date(ultrasoundDate);
                const daysPregnant = weeks * 7 + days;
                const daysRemaining = 280 - daysPregnant;
                dueDate = new Date(ultrasound.getTime() + daysRemaining * 24 * 60 * 60 * 1000);

            } else if (currentMethod === 'conception') {
                const conceptionDateInput = document.getElementById('conception-date').value;

                if (!conceptionDateInput) {
                    alert('Please enter the conception date.');
                    return;
                }

                // Calculate due date: conception date + 266 days (38 weeks)
                const conception = new Date(conceptionDateInput);
                dueDate = new Date(conception.getTime() + 266 * 24 * 60 * 60 * 1000);

            } else if (currentMethod === 'ivf') {
                const transferDate = document.getElementById('ivf-transfer-date').value;
                const embryoAge = parseInt(document.getElementById('embryo-age').value);

                if (!transferDate) {
                    alert('Please enter the transfer date.');
                    return;
                }

                // Calculate due date: transfer date + (266 - embryo age) days
                const transfer = new Date(transferDate);
                const daysToAdd = 266 - embryoAge;
                dueDate = new Date(transfer.getTime() + daysToAdd * 24 * 60 * 60 * 1000);
            }

            // Calculate conception date (14 days after LMP or due date - 266 days)
            const conceptionDate = new Date(dueDate.getTime() - 266 * 24 * 60 * 60 * 1000);

            // Calculate current pregnancy stats
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            dueDate.setHours(0, 0, 0, 0);

            const daysToGo = Math.ceil((dueDate - today) / (1000 * 60 * 60 * 24));
            const daysSinceConception = Math.ceil((today - conceptionDate) / (1000 * 60 * 60 * 24));
            const currentWeek = Math.floor(daysSinceConception / 7);
            const currentDay = daysSinceConception % 7;

            // Calculate progress percentage
            const totalDays = 280;
            const progressPercentage = Math.min(Math.max((daysSinceConception / totalDays) * 100, 0), 100);

            // Determine trimester
            let trimester, trimesterInfo;
            if (currentWeek <= 12) {
                trimester = 'First Trimester';
                trimesterInfo = 'You are in the first trimester. This is a critical period of development where the baby\'s organs and body systems begin to form. Common symptoms include morning sickness, fatigue, and breast tenderness.';
            } else if (currentWeek <= 26) {
                trimester = 'Second Trimester';
                trimesterInfo = 'You are in the second trimester. Often called the "golden period" of pregnancy, many women feel more energetic. The baby is growing rapidly and you may start to feel movements.';
            } else {
                trimester = 'Third Trimester';
                trimesterInfo = 'You are in the third trimester. The baby is continuing to grow and develop, preparing for birth. You may experience increased discomfort as the baby grows larger.';
            }

            // Format dates
            const formatDate = (date) => {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            };

            // Display results
            document.getElementById('result-due-date').textContent = formatDate(dueDate);
            document.getElementById('result-current-week').textContent = `Week ${currentWeek}, Day ${currentDay}`;
            document.getElementById('result-days-to-go').textContent = daysToGo > 0 ? `${daysToGo} days` : 'Due date passed';
            document.getElementById('result-conception-date').textContent = formatDate(conceptionDate);
            document.getElementById('progress-percentage').textContent = `${progressPercentage.toFixed(1)}%`;
            document.getElementById('progress-bar').style.width = progressPercentage + '%';
            document.getElementById('trimester-info').innerHTML = `<strong>${trimester}</strong><br>${trimesterInfo}`;

            // Calculate and display milestones
            const milestones = [];
            const firstTrimesterEnd = new Date(conceptionDate.getTime() + 84 * 24 * 60 * 60 * 1000);
            const secondTrimesterEnd = new Date(conceptionDate.getTime() + 182 * 24 * 60 * 60 * 1000);
            const fullTerm = new Date(dueDate.getTime() - 21 * 24 * 60 * 60 * 1000); // 37 weeks

            milestones.push({
                date: firstTrimesterEnd,
                text: 'End of First Trimester (Week 12)',
                passed: today > firstTrimesterEnd
            });
            milestones.push({
                date: secondTrimesterEnd,
                text: 'End of Second Trimester (Week 26)',
                passed: today > secondTrimesterEnd
            });
            milestones.push({
                date: fullTerm,
                text: 'Full Term (Week 37)',
                passed: today > fullTerm
            });
            milestones.push({
                date: dueDate,
                text: 'Due Date (Week 40)',
                passed: today > dueDate
            });

            let milestonesHTML = '<div style="display: grid; gap: 15px;">';
            milestones.forEach(milestone => {
                const icon = milestone.passed ? '✓' : '○';
                const color = milestone.passed ? '#27ae60' : '#e91e63';
                const textDecoration = milestone.passed ? 'line-through' : 'none';
                milestonesHTML += `
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px; color: ${color}; font-weight: bold;">${icon}</span>
                        <div>
                            <div style="font-weight: 600; color: #2c3e50; text-decoration: ${textDecoration};">${milestone.text}</div>
                            <div style="font-size: 14px; color: #7f8c8d;">${formatDate(milestone.date)}</div>
                        </div>
                    </div>
                `;
            });
            milestonesHTML += '</div>';
            document.getElementById('milestones-list').innerHTML = milestonesHTML;

            // Show results
            pregnancyResult.style.display = 'block';

            // Smooth scroll to results
            pregnancyResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });

        // Hover effect for calculate button
        const calculateBtn = pregnancyForm.querySelector('button[type="submit"]');
        calculateBtn.addEventListener('mouseenter', function() {
            this.style.background = '#c2185b';
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 15px rgba(233, 30, 99, 0.3)';
        });
        calculateBtn.addEventListener('mouseleave', function() {
            this.style.background = '#e91e63';
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
</script>
