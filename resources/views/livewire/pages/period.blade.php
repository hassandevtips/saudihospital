@include('livewire.includes.page-hero')

<section class="service-details p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                @include('livewire.includes.left-menu')
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">

                <div class="period-calculator-wrapper">
                    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">{{ gt('period_calculator', 'Period Calculator') }}</h2>
                    <p style="text-align: center; color: #7f8c8d; margin-bottom: 40px; font-size: 16px;">
                        {{ gt('period_calculator_description', 'Use this calculator to estimate the future period days or the most probable ovulation days.') }}
                    </p>

                    <!-- Period Form -->
                    <form id="period-form">
                        <div class="form-row" style="margin-bottom: 25px;">
                            <div class="col-md-12" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('first_day_last_period', 'First Day of Your Last Period') }}</label>
                                <input type="date" id="last-period-date" class="form-control" required
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom: 25px;">
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('how_long_did_it_last', 'How long did it last?') }}</label>
                                <select id="period-duration" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="1">{{ gt('1_day', '1 day') }}</option>
                                    <option value="2">{{ gt('2_days', '2 days') }}</option>
                                    <option value="3">{{ gt('3_days', '3 days') }}</option>
                                    <option value="4">{{ gt('4_days', '4 days') }}</option>
                                    <option value="5" selected>{{ gt('5_days', '5 days') }}</option>
                                    <option value="6">{{ gt('6_days', '6 days') }}</option>
                                    <option value="7">{{ gt('7_days', '7 days') }}</option>
                                    <option value="8">{{ gt('8_days', '8 days') }}</option>
                                    <option value="9">{{ gt('9_days', '9 days') }}</option>
                                    <option value="10">{{ gt('10_days', '10 days') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="padding: 0 10px;">
                                <label
                                    style="font-weight: 600; color: #2c3e50; margin-bottom: 8px; display: block;">{{ gt('average_length_cycles', 'Average Length of Cycles') }}</label>
                                <select id="cycle-length" class="form-control"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                    <option value="22">{{ gt('22_days', '22 days') }}</option>
                                    <option value="23">{{ gt('23_days', '23 days') }}</option>
                                    <option value="24">{{ gt('24_days', '24 days') }}</option>
                                    <option value="25">{{ gt('25_days', '25 days') }}</option>
                                    <option value="26">{{ gt('26_days', '26 days') }}</option>
                                    <option value="27">{{ gt('27_days', '27 days') }}</option>
                                    <option value="28" selected>{{ gt('28_days', '28 days') }}</option>
                                    <option value="29">{{ gt('29_days', '29 days') }}</option>
                                    <option value="30">{{ gt('30_days', '30 days') }}</option>
                                    <option value="31">{{ gt('31_days', '31 days') }}</option>
                                    <option value="32">{{ gt('32_days', '32 days') }}</option>
                                    <option value="33">{{ gt('33_days', '33 days') }}</option>
                                    <option value="34">{{ gt('34_days', '34 days') }}</option>
                                    <option value="35">{{ gt('35_days', '35 days') }}</option>
                                    <option value="36">{{ gt('36_days', '36 days') }}</option>
                                    <option value="37">{{ gt('37_days', '37 days') }}</option>
                                    <option value="38">{{ gt('38_days', '38 days') }}</option>
                                    <option value="39">{{ gt('39_days', '39 days') }}</option>
                                    <option value="40">{{ gt('40_days', '40 days') }}</option>
                                    <option value="41">{{ gt('41_days', '41 days') }}</option>
                                    <option value="42">{{ gt('42_days', '42 days') }}</option>
                                    <option value="43">{{ gt('43_days', '43 days') }}</option>
                                    <option value="44">{{ gt('44_days', '44 days') }}</option>
                                </select>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 30px;">
                            <button type="submit"
                                style="padding: 15px 60px; background: #e91e63; color: white; border: none; border-radius: 5px; font-size: 18px; font-weight: 600; cursor: pointer; transition: all 0.3s;">{{ gt('calculate', 'Calculate') }}</button>
                        </div>
                    </form>

                    <!-- Results Section -->
                    <div id="period-result" style="margin-top: 40px; display: none;">
                        <div style="background: #ecf0f1; padding: 30px; border-radius: 10px;">
                            <h3 style="color: #2c3e50; margin-bottom: 25px; text-align: center;">{{ gt('your_cycle_predictions', 'Your Cycle Predictions') }}</h3>

                            <!-- Calendar View -->
                            <div id="calendar-container" style="margin-bottom: 30px;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <button type="button" id="prev-month"
                                        style="padding: 8px 15px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                        ← {{ gt('previous', 'Previous') }}
                                    </button>
                                    <h4 id="calendar-month" style="color: #2c3e50; margin: 0;"></h4>
                                    <button type="button" id="next-month"
                                        style="padding: 8px 15px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                        {{ gt('next', 'Next') }} →
                                    </button>
                                </div>
                                <div id="calendar-grid"></div>
                            </div>

                            <!-- Legend -->
                            <div
                                style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-top: 30px; padding: 20px; background: white; border-radius: 8px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 20px; height: 20px; background: #e91e63; border-radius: 3px;">
                                    </div>
                                    <span style="color: #2c3e50; font-size: 14px;">{{ gt('period_days', 'Period Days') }}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 20px; height: 20px; background: #9c27b0; border-radius: 3px;">
                                    </div>
                                    <span style="color: #2c3e50; font-size: 14px;">{{ gt('ovulation_day', 'Ovulation Day') }}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 20px; height: 20px; background: #ffeb3b; border-radius: 3px;">
                                    </div>
                                    <span style="color: #2c3e50; font-size: 14px;">{{ gt('fertile_window', 'Fertile Window') }}</span>
                                </div>
                            </div>

                            <!-- Next Period Info -->
                            <div style="margin-top: 30px; padding: 20px; background: white; border-radius: 8px;">
                                <h4 style="color: #2c3e50; margin-bottom: 15px;">{{ gt('next_period_information', 'Next Period Information') }}</h4>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('next_period_starts', 'Next Period Starts') }}:</strong> <span id="next-period-date"></span>
                                </div>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('expected_duration', 'Expected Duration') }}:</strong> <span id="expected-duration"></span> {{ gt('days', 'days') }}
                                </div>
                                <div style="margin-bottom: 10px; font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('ovulation_date', 'Ovulation Date') }}:</strong> <span id="ovulation-date"></span>
                                </div>
                                <div style="font-size: 16px; color: #34495e;">
                                    <strong>{{ gt('fertile_window', 'Fertile Window') }}:</strong> <span id="fertile-window"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Information Section -->
                    <div style="margin-top: 50px;">
                        <h3 style="color: #2c3e50; margin-bottom: 20px;">{{ gt('about_menstrual_cycle', 'About Menstrual Cycle') }}</h3>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('menstrual_cycle_description', 'The menstrual cycle is a series of changes that occur in a woman\'s body as part of the preparation for the possibility of pregnancy occurring. It is a cycle that usually begins between 12 and 15 years of age that continues up until menopause, which, on average, occurs at the age of 52. The menstrual cycle is typically counted from the first day of one period to the first day of the next.') }}
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">{{ gt('understanding_your_cycle', 'Understanding Your Cycle') }}
                        </h4>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('regular_menstrual_cycle_description', 'A regular menstrual cycle is considered to be a menstrual cycle where the longest and shortest cycles vary by less than 8 days. The average menstrual cycle lasts 28 days. As part of the menstrual cycle, the lining of the uterus thickens, and an egg, which is required for pregnancy to occur, is produced.') }}
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">{{ gt('ovulation', 'Ovulation') }}</h4>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('ovulation_description', 'The egg is released from the ovaries in a process called ovulation, which corresponds with the time during which a woman is most fertile (~5 days before ovulation, up through 1-2 days after ovulation). If the egg is not fertilized, pregnancy cannot happen, and the lining of the uterus will shed during a menstrual period, after which the cycle restarts.') }}
                        </p>

                        <h4 style="color: #2c3e50; margin-top: 30px; margin-bottom: 15px;">{{ gt('period', 'Period') }}</h4>
                        <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 15px;">
                            {{ gt('period_description', 'A period, a commonly used term for referring to menstruation, is a woman\'s regular discharge of blood and mucosal tissue that occurs as part of the menstrual cycle. Bleeding and discharge of the mucosal lining of the uterus, through the vagina, usually lasts between 2 and 7 days.') }}
                        </p>

                        <div
                            style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; margin-top: 30px; border-radius: 5px;">
                            <h4 style="color: #856404; margin-bottom: 10px;">{{ gt('important_note', 'Important Note') }}</h4>
                            <p style="color: #856404; margin: 0; line-height: 1.6;">
                                {{ gt('period_calculator_disclaimer', 'This calculator provides estimates based on average cycle lengths. Individual cycles can vary, and many factors can affect your menstrual cycle. For personalized medical advice, please consult with your healthcare provider.') }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@script
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const periodForm = document.getElementById('period-form');
        const periodResult = document.getElementById('period-result');
        let currentDisplayMonth = new Date();
        let periodDates = [];
        let ovulationDates = [];
        let fertileDates = [];
        let cycleData = {};

        // Set max date to today for the date input
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('last-period-date').setAttribute('max', today);

        // Period Calculation
        periodForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const lastPeriodDate = new Date(document.getElementById('last-period-date').value);
            const periodDuration = parseInt(document.getElementById('period-duration').value);
            const cycleLength = parseInt(document.getElementById('cycle-length').value);

            if (!lastPeriodDate || isNaN(lastPeriodDate.getTime())) {
                alert('{{ gt("invalid_period_date", "Please select a valid date for your last period.") }}');
                return;
            }

            // Store cycle data
            cycleData = {
                lastPeriodDate,
                periodDuration,
                cycleLength
            };

            // Calculate next 6 cycles
            periodDates = [];
            ovulationDates = [];
            fertileDates = [];

            for (let i = 0; i < 6; i++) {
                // Calculate period start date
                const periodStart = new Date(lastPeriodDate);
                periodStart.setDate(periodStart.getDate() + (cycleLength * i));

                // Add period days
                for (let j = 0; j < periodDuration; j++) {
                    const periodDay = new Date(periodStart);
                    periodDay.setDate(periodDay.getDate() + j);
                    periodDates.push(periodDay.toDateString());
                }

                // Calculate ovulation (typically 14 days before next period)
                const ovulationDay = new Date(periodStart);
                ovulationDay.setDate(ovulationDay.getDate() + cycleLength - 14);
                ovulationDates.push(ovulationDay.toDateString());

                // Calculate fertile window (5 days before ovulation + ovulation day + 1 day after)
                for (let j = -5; j <= 1; j++) {
                    const fertileDay = new Date(ovulationDay);
                    fertileDay.setDate(fertileDay.getDate() + j);
                    if (!ovulationDates.includes(fertileDay.toDateString())) {
                        fertileDates.push(fertileDay.toDateString());
                    }
                }
            }

            // Display next period information
            const nextPeriodStart = new Date(lastPeriodDate);
            nextPeriodStart.setDate(nextPeriodStart.getDate() + cycleLength);

            const nextOvulation = new Date(nextPeriodStart);
            nextOvulation.setDate(nextOvulation.getDate() - 14);

            const fertileStart = new Date(nextOvulation);
            fertileStart.setDate(fertileStart.getDate() - 5);

            const fertileEnd = new Date(nextOvulation);
            fertileEnd.setDate(fertileEnd.getDate() + 1);

            document.getElementById('next-period-date').textContent = formatDate(nextPeriodStart);
            document.getElementById('expected-duration').textContent = periodDuration;
            document.getElementById('ovulation-date').textContent = formatDate(nextOvulation);
            document.getElementById('fertile-window').textContent =
                `${formatDate(fertileStart)} - ${formatDate(fertileEnd)}`;

            // Set current display month to next period month
            currentDisplayMonth = new Date(nextPeriodStart.getFullYear(), nextPeriodStart.getMonth(), 1);

            // Render calendar
            renderCalendar();

            // Show results
            periodResult.style.display = 'block';

            // Smooth scroll to results
            periodResult.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        });

        // Calendar navigation
        document.getElementById('prev-month').addEventListener('click', function() {
            currentDisplayMonth.setMonth(currentDisplayMonth.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('next-month').addEventListener('click', function() {
            currentDisplayMonth.setMonth(currentDisplayMonth.getMonth() + 1);
            renderCalendar();
        });

        // Render calendar function
        function renderCalendar() {
            const year = currentDisplayMonth.getFullYear();
            const month = currentDisplayMonth.getMonth();

            // Update month display
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            document.getElementById('calendar-month').textContent = `${monthNames[month]} ${year}`;

            // Get first day of month and number of days
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Build calendar grid
            let calendarHTML = '<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px;">';

            // Day headers
            const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayHeaders.forEach(day => {
                calendarHTML +=
                    `<div style="text-align: center; font-weight: 600; color: #2c3e50; padding: 10px; background: #bdc3c7; border-radius: 5px;">${day}</div>`;
            });

            // Empty cells for days before month starts
            for (let i = 0; i < firstDay; i++) {
                calendarHTML += '<div></div>';
            }

            // Calendar days
            for (let day = 1; day <= daysInMonth; day++) {
                const currentDate = new Date(year, month, day);
                const dateString = currentDate.toDateString();
                const today = new Date();
                const isToday = currentDate.toDateString() === today.toDateString();

                let bgColor = 'white';
                let textColor = '#2c3e50';
                let borderColor = '#ddd';

                if (periodDates.includes(dateString)) {
                    bgColor = '#e91e63';
                    textColor = 'white';
                } else if (ovulationDates.includes(dateString)) {
                    bgColor = '#9c27b0';
                    textColor = 'white';
                } else if (fertileDates.includes(dateString)) {
                    bgColor = '#ffeb3b';
                    textColor = '#2c3e50';
                }

                if (isToday) {
                    borderColor = '#3498db';
                }

                calendarHTML += `
                    <div style="
                        text-align: center;
                        padding: 12px;
                        background: ${bgColor};
                        color: ${textColor};
                        border: 2px solid ${borderColor};
                        border-radius: 5px;
                        font-weight: ${isToday ? '700' : '400'};
                        min-height: 45px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        ${day}
                    </div>
                `;
            }

            calendarHTML += '</div>';
            document.getElementById('calendar-grid').innerHTML = calendarHTML;
        }

        // Format date helper
        function formatDate(date) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return date.toLocaleDateString('en-US', options);
        }

        // Hover effect for calculate button
        const calculateBtn = periodForm.querySelector('button[type="submit"]');
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
@endscript
