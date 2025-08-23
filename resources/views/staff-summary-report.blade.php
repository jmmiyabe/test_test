<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- 🔹 Filter Form (Top) -->
        <form method="GET" action="{{ route('summary-report') }}" class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800">Summary Report</h2>
                <div class="flex space-x-6">
                    <div>
                        <label class="font-semibold text-gray-700">Month:</label>
                        <select name="month" class="rounded-lg border-gray-300 p-2 w-32">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == $selectedMonth ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="font-semibold text-gray-700">Year:</label>
                        <select name="year" class="rounded-lg border-gray-300 p-2 w-32">
                            @for ($i = 2020; $i <= now()->year; $i++)
                                <option value="{{ $i }}" {{ $i == $selectedYear ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600">
                        Apply Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- 🔹 Summary Cards -->
        <div class="grid grid-cols-3 gap-4">
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <h3 class="text-lg font-semibold">Total Patients</h3>
                <p class="text-2xl font-bold">{{ $totalPatients }}</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <h3 class="text-lg font-semibold">Attended</h3>
                <p class="text-2xl font-bold text-green-500">{{ $attendedCount }}</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg text-center">
                <h3 class="text-lg font-semibold">Cancelled</h3>
                <p class="text-2xl font-bold text-red-500">{{ $cancelledCount }}</p>
            </div>
        </div>

        <!-- 🔹 Charts Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
            <h3 class="text-xl font-semibold text-gray-800 text-center mb-4">Appointments Overview</h3>
            <div class="relative h-[400px] w-full">
                <canvas id="appointmentMeter"></canvas>
            </div>
        </div>

        <!-- 🔹 Diagnosis & Medications Charts (Side by Side) -->
        <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
            <h3 class="text-xl font-semibold text-gray-800 text-center mb-4">Top 5 Prescribed Medications & Most Common Diagnoses</h3>
            <div class="flex space-x-8">
                <div class="relative h-[400px] w-1/2 p-4 bg-white shadow-lg rounded-lg">
                    <canvas id="medicationChart"></canvas>
                </div>
                <div class="relative h-[400px] w-1/2 p-4 bg-white shadow-lg rounded-lg">
                    <canvas id="diagnosisChart"></canvas>
                </div>
            </div>
        </div>

        <!-- 🔹 Generate Accomplishment Report Button -->
        <div class="flex justify-end mt-6">
            <a href="{{ route('generate.accomplishment.report') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg">
                Generate Accomplishment Report
            </a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function renderDoughnut() {
                const ctx = document.getElementById('appointmentMeter').getContext('2d');
                const attendedCount = @json($attendedCount);
                const cancelledCount = @json($cancelledCount);
                const totalAppointments = attendedCount + cancelledCount;
                const attendedPercentage = totalAppointments > 0 ? (attendedCount / totalAppointments) * 100 : 0;
                const cancelledPercentage = totalAppointments > 0 ? (cancelledCount / totalAppointments) * 100 : 0;

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Attended Appointments', 'Cancelled Appointments'],
                        datasets: [{
                            data: [attendedPercentage, cancelledPercentage],
                            backgroundColor: ['#4CAF50', '#FF5733'],
                            borderWidth: 2
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, cutout: '70%', legend: { position: 'bottom' } }
                });
            }

            function renderCharts() {
                const ctxMed = document.getElementById('medicationChart').getContext('2d');
                const ctxDiag = document.getElementById('diagnosisChart').getContext('2d');
                const medications = @json($medications);
                const diagnoses = @json($diagnoses);

                // ✅ Fixed: Medication Graph is now Horizontal Bar Chart
                new Chart(ctxMed, {
                    type: 'bar',
                    data: {
                        labels: medications.map(m => m.name),
                        datasets: [{
                            label: 'Quantity Dispensed',
                            data: medications.map(m => m.quantity_dispensed),
                            backgroundColor: '#4CAF50'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        scales: {
                            x: { title: { display: true, text: 'Quantity Dispensed' } },
                            y: {
                                title: { display: true, text: 'Medications' },
                                ticks: { autoSkip: false, maxTicksLimit: 10 }
                            }
                        },
                        plugins: { legend: { position: 'top' } }
                    }
                });

                new Chart(ctxDiag, {
                    type: 'pie',
                    data: {
                        labels: diagnoses.map(d => d.diagnosis),
                        datasets: [{ data: diagnoses.map(d => d.count), backgroundColor: ['#FF9F40', '#FF6384', '#36A2EB'] }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, legend: { position: 'top' } }
                });
            }

            renderDoughnut();
            renderCharts();
        });
    </script>
</x-app-layout>
