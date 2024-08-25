<!-- resources/views/components/yemenia-form.blade.php -->
<div>
    <h1>Search Flight Schedule</h1>
    <form action="{{ route('yemenia.search') }}" method="get">
        <div class="form-group">
            <label for="from">From</label>
            <select name="from" id="from" required class="form-control" aria-required="true" aria-label="Select departure location">
                <option value="">Select departure location</option>
                @foreach($locations as $location)
                <option value="{{ $location->code }}" {{ old('from', '6456') == $location->code ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to">To</label>
            <select name="to" id="to" required class="form-control" aria-required="true" aria-label="Select arrival location">
                <option value="">Select arrival location</option>
                @foreach($locations as $location)
                <option value="{{ $location->code }}" {{ old('to', '1666') == $location->code ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" required class="form-control" aria-required="true" aria-label="Select date" value="{{ old('date', date('Y-m-d')) }}">
        </div>
        <button type="submit" class="btn btn-primary">Search Flight Schedules</button>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fromSelect = document.getElementById('from');
            const toSelect = document.getElementById('to');
            const options = Array.from(toSelect.options);
            
            fromSelect.addEventListener('change', function () {
                const selectedFrom = fromSelect.value;
                // Enable all options in the 'to' select
                options.forEach(option => option.disabled = false);

                // Disable the selected 'from' option in the 'to' select
                if (selectedFrom) {
                    options.forEach(option => {
                        if (option.value === selectedFrom) {
                            option.disabled = true;
                        }
                    });
                }
            });

            toSelect.addEventListener('change', function () {
                const selectedTo = toSelect.value;
                // Enable all options in the 'from' select
                Array.from(fromSelect.options).forEach(option => option.disabled = false);

                // Disable the selected 'to' option in the 'from' select
                if (selectedTo) {
                    Array.from(fromSelect.options).forEach(option => {
                        if (option.value === selectedTo) {
                            option.disabled = true;
                        }
                    });
                }
            });
        });
    </script>
</div>
