<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Submit a crime incident report for review in Victoria, Oriental Mindoro.">
    <title>Report an Incident | Victoria Safe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/pages/crime-report.js'])
</head>

<body class="crime-report-page">
    <header class="site-header crime-map-header">
        <div class="container navbar">
            <a href="{{ route('home') }}" class="brand" aria-label="Victoria Safe Home">
                <span class="brand-mark" aria-hidden="true">VS</span>
                <span class="brand-text">
                    <span class="brand-name">Victoria Safe</span>
                    <span class="brand-subtitle">Crime Mapping System</span>
                </span>
            </a>

            <nav class="nav-links" aria-label="Primary navigation">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('crime-map') }}" class="nav-link">Crime Map</a>
                <a href="{{ route('analytics-dashboard') }}" class="nav-link">Analytics</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="crime-map-hero report-hero">
            <div class="container crime-map-hero-content">
                <div class="crime-map-hero-copy">
                    <div class="hero-eyebrow">
                        <span class="hero-eyebrow-dot"></span>
                        Community Report
                    </div>
                    <h1 class="crime-map-title">
                        Report an Incident
                        <span>Victoria, Oriental Mindoro.</span>
                    </h1>
                    <p class="crime-map-description">
                        Share the incident details and select its location on the map.
                        Reports are reviewed before appearing publicly.
                    </p>
                </div>
            </div>
        </section>

        <section class="report-section">
            <div class="container report-container">
                @if (session('report_reference'))
                    <div class="report-success" role="status">
                        Salamat. Naisumite ang report #{{ session('report_reference') }} at nakabinbin ito para sa review.
                        Hindi ito makikita sa public map hanggang maaprubahan.
                    </div>
                @endif

                <form
                    class="report-form"
                    id="crime-report-form"
                    method="POST"
                    action="{{ route('crime-reports.store') }}"
                >
                    @csrf

                    <div class="report-form-heading">
                        <span class="section-eyebrow">Incident Details</span>
                        <h2>Submit a Crime Report</h2>
                        <p>Huwag maglagay ng pangalan, contact details, o impormasyong maaaring makakilala sa tao.</p>
                    </div>

                    @if ($errors->any())
                        <div class="report-errors" role="alert">
                            <p>Paki-check ang mga sumusunod:</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="report-fields">
                        <div class="report-field">
                            <label for="type">Uri ng insidente</label>
                            <select id="type" name="type" required>
                                <option value="">Pumili ng uri</option>
                                @foreach (['theft' => 'Theft', 'robbery' => 'Robbery', 'assault' => 'Assault', 'burglary' => 'Burglary', 'vandalism' => 'Vandalism', 'other' => 'Other'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('type') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="report-field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="report-field">
                            <label for="date">Petsa ng insidente</label>
                            <input
                                id="date"
                                name="date"
                                type="date"
                                max="{{ now()->toDateString() }}"
                                value="{{ old('date') }}"
                                required
                            >
                            @error('date') <span class="report-field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="report-field">
                            <label for="barangay_id">Barangay <span>(optional)</span></label>
                            <select id="barangay_id" name="barangay_id">
                                <option value="">Hindi sigurado / hindi nakalista</option>
                                @foreach ($barangays as $barangay)
                                    <option value="{{ $barangay->id }}" @selected((string) old('barangay_id') === (string) $barangay->id)>
                                        {{ $barangay->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barangay_id') <span class="report-field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="report-field report-field-wide">
                            <label for="description">Paglalarawan ng insidente</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                maxlength="2000"
                                required
                                placeholder="Ilarawan lamang ang pangyayari. Huwag maglagay ng personal na detalye."
                            >{{ old('description') }}</textarea>
                            @error('description') <span class="report-field-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="report-location-heading">
                        <div>
                            <label for="report-location-map">Lokasyon sa mapa</label>
                            <p>I-click ang aktuwal na lokasyon ng insidente sa mapa.</p>
                        </div>
                        <output id="selected-coordinates" aria-live="polite">
                            Wala pang napipiling lokasyon
                        </output>
                    </div>

                    <div
                        id="report-location-map"
                        class="report-location-map"
                        tabindex="0"
                        role="application"
                        aria-label="Pumili ng lokasyon ng insidente sa mapa ng Victoria, Oriental Mindoro"
                    ></div>

                    <input id="latitude" name="latitude" type="hidden" value="{{ old('latitude') }}">
                    <input id="longitude" name="longitude" type="hidden" value="{{ old('longitude') }}">
                    @error('latitude') <span class="report-field-error">{{ $message }}</span> @enderror
                    @error('longitude') <span class="report-field-error">{{ $message }}</span> @enderror
                    <p class="report-map-error" id="report-map-error" role="alert" hidden>
                        Pumili muna ng lokasyon sa mapa bago isumite.
                    </p>

                    <div class="report-privacy-notice">
                        Ang report ay mase-save bilang <strong>pending</strong>. Staff lamang ang maaaring mag-review at mag-apruba.
                        Hindi ito emergency service; kung may agarang panganib, tumawag sa emergency services.
                    </div>

                    <button class="btn btn-primary report-submit-button" type="submit">
                        Isumite para sa Review
                    </button>
                </form>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <p>&copy; {{ date('Y') }} Victoria, Oriental Mindoro Crime Mapping System</p>
            <div class="footer-status"><span class="footer-status-dot"></span> Reports require review</div>
        </div>
    </footer>
</body>
</html>
