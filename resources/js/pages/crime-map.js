import L from 'leaflet';

document.addEventListener('DOMContentLoaded', () => {
    const crimeMapPage = document.querySelector('.crime-map-page');

    // Run only on the Crime Map page.
    if (!crimeMapPage) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const locationSearch = document.querySelector('#location-search');
    const crimeTypeFilter = document.querySelector('#crime-type');
    const riskLevelFilter = document.querySelector('#risk-level');
    const incidentDateFilter = document.querySelector('#incident-date');
    const resetButton = document.querySelector('.filter-reset-button');

    const incidentRows = [
        ...document.querySelectorAll('[data-incident-row]'),
    ];
    const mapCanvas = document.querySelector('#crime-map');
    const mapStatus = document.querySelector('#crime-map-status');

    const crimeMap = L.map(mapCanvas).setView(
        [13.1733849, 121.2787746],
        14
    );

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
    }).addTo(crimeMap);

    const riskColors = {
        high: getComputedStyle(document.documentElement)
            .getPropertyValue('--color-danger')
            .trim(),
        moderate: getComputedStyle(document.documentElement)
            .getPropertyValue('--color-warning')
            .trim(),
        monitored: getComputedStyle(document.documentElement)
            .getPropertyValue('--color-primary-600')
            .trim(),
    };

    const incidentMarkers = new Map();

    const visibleIncidentCount = document.querySelector(
        '#visible-incident-count'
    );

    const incidentCountLabel = document.querySelector(
        '#incident-count-label'
    );

    /*
    |--------------------------------------------------------------------------
    | Incident Modal
    |--------------------------------------------------------------------------
    */

    const incidentModal = document.querySelector('#incident-modal');

    const modalIncidentId = document.querySelector('#modal-incident-id');
    const modalIncidentType = document.querySelector('#modal-incident-type');
    const modalIncidentLocation = document.querySelector(
        '#modal-incident-location'
    );
    const modalIncidentDate = document.querySelector('#modal-incident-date');
    const modalIncidentRisk = document.querySelector('#modal-incident-risk');
    const modalIncidentDescription = document.querySelector(
        '#modal-incident-description'
    );

    const closeModalButtons = [
        ...document.querySelectorAll('[data-close-incident-modal]'),
    ];

    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    */

    const formatText = (value) => {
        if (!value) {
            return '—';
        }

        return value
            .split(' ')
            .map((word) => {
                return word.charAt(0).toUpperCase() + word.slice(1);
            })
            .join(' ');
    };

    const formatRiskLevel = (risk) => {
        if (risk === 'high') {
            return 'High Risk';
        }

        if (risk === 'moderate') {
            return 'Moderate Risk';
        }

        if (risk === 'monitored') {
            return 'Monitored';
        }

        return formatText(risk);
    };

    const formatIncidentDate = (dateValue) => {
        if (!dateValue) {
            return '—';
        }

        const [year, month, day] = dateValue.split('-');

        const date = new Date(
            Number(year),
            Number(month) - 1,
            Number(day)
        );

        return new Intl.DateTimeFormat('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
        }).format(date);
    };

    const findIncidentById = (incidentId) => {
        return incidentRows.find((row) => {
            return row.dataset.id === incidentId;
        });
    };

    /*
    |--------------------------------------------------------------------------
    | Incident Counter
    |--------------------------------------------------------------------------
    */

    const updateIncidentCount = (count) => {
        if (visibleIncidentCount) {
            visibleIncidentCount.textContent = count;
        }

        if (incidentCountLabel) {
            incidentCountLabel.textContent =
                `${count} ${count === 1 ? 'incident' : 'incidents'}`;
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Filtering
    |--------------------------------------------------------------------------
    */

    const filterIncidents = () => {
        const searchValue = locationSearch.value
            .trim()
            .toLowerCase();

        const selectedCrimeType = crimeTypeFilter.value;
        const selectedRiskLevel = riskLevelFilter.value;
        const selectedDate = incidentDateFilter.value;

        let visibleCount = 0;

        incidentRows.forEach((row) => {
            const incidentType = row.dataset.type;
            const incidentLocation = row.dataset.location;
            const incidentDate = row.dataset.date;
            const incidentRisk = row.dataset.risk;

            const matchesLocation =
                searchValue === '' ||
                incidentLocation.includes(searchValue);

            const matchesCrimeType =
                selectedCrimeType === 'all' ||
                incidentType === selectedCrimeType;

            const matchesRiskLevel =
                selectedRiskLevel === 'all' ||
                incidentRisk === selectedRiskLevel;

            const matchesDate =
                selectedDate === '' ||
                incidentDate === selectedDate;

            const isVisible =
                matchesLocation &&
                matchesCrimeType &&
                matchesRiskLevel &&
                matchesDate;

            row.hidden = !isVisible;

            if (isVisible) {
                visibleCount++;
            }
        });

        updateMapMarkers();
        updateIncidentCount(visibleCount);
    };

    /*
    |--------------------------------------------------------------------------
    | Open Incident Modal
    |--------------------------------------------------------------------------
    */

    const openIncidentModal = (incidentId) => {
        const incident = findIncidentById(incidentId);

        if (!incident || !incidentModal) {
            return;
        }

        modalIncidentId.textContent =
            `Incident #${incident.dataset.id}`;

        modalIncidentType.textContent =
            formatText(incident.dataset.type);

        modalIncidentLocation.textContent =
            formatText(incident.dataset.location);

        modalIncidentDate.textContent =
            formatIncidentDate(incident.dataset.date);

        modalIncidentRisk.textContent =
            formatRiskLevel(incident.dataset.risk);

        modalIncidentDescription.textContent =
            incident.dataset.description || 'No description provided.';

        incidentModal.classList.add('is-open');
        incidentModal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('modal-open');

        const closeButton = incidentModal.querySelector(
            '.incident-modal-close'
        );

        if (closeButton) {
            closeButton.focus();
        }
    };

    incidentRows.forEach((row) => {
        const latitude = Number.parseFloat(row.dataset.latitude);
        const longitude = Number.parseFloat(row.dataset.longitude);

        if (
            !Number.isFinite(latitude) ||
            !Number.isFinite(longitude) ||
            latitude < -90 ||
            latitude > 90 ||
            longitude < -180 ||
            longitude > 180
        ) {
            return;
        }

        const marker = L.circleMarker([latitude, longitude], {
            radius: 9,
            color: '#ffffff',
            weight: 2,
            fillColor: riskColors[row.dataset.risk] || riskColors.monitored,
            fillOpacity: 0.95,
        });

        const tooltip = document.createElement('span');
        tooltip.textContent =
            `${formatText(row.dataset.type)} — ${formatText(row.dataset.location)}`;
        marker.bindTooltip(tooltip);
        marker.on('click', () => openIncidentModal(row.dataset.id));
        incidentMarkers.set(row.dataset.id, marker);
    });

    if (incidentMarkers.size > 0) {
        const markerBounds = L.featureGroup([...incidentMarkers.values()])
            .getBounds();

        crimeMap.fitBounds(markerBounds, { maxZoom: 15, padding: [24, 24] });
    }

    const updateMapMarkers = () => {
        let visibleMappedCount = 0;

        incidentRows.forEach((row) => {
            const marker = incidentMarkers.get(row.dataset.id);

            if (!marker) {
                return;
            }

            if (row.hidden) {
                crimeMap.removeLayer(marker);
                return;
            }

            marker.addTo(crimeMap);
            visibleMappedCount++;
        });

        if (!mapStatus) {
            return;
        }

        if (incidentMarkers.size === 0) {
            mapStatus.textContent = incidentRows.length === 0
                ? 'No incident records are available yet.'
                : 'No incidents have coordinates yet. Add latitude and longitude to show markers.';
        } else if (visibleMappedCount === 0) {
            mapStatus.textContent = 'No mapped incidents match the selected filters.';
        } else {
            mapStatus.textContent =
                `Showing ${visibleMappedCount} mapped ${visibleMappedCount === 1 ? 'incident' : 'incidents'}.`;
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Close Incident Modal
    |--------------------------------------------------------------------------
    */

    const closeIncidentModal = () => {
        if (!incidentModal) {
            return;
        }

        incidentModal.classList.remove('is-open');
        incidentModal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('modal-open');
    };

    /*
    |--------------------------------------------------------------------------
    | Filter Events
    |--------------------------------------------------------------------------
    */

    locationSearch.addEventListener('input', filterIncidents);

    crimeTypeFilter.addEventListener('change', filterIncidents);

    riskLevelFilter.addEventListener('change', filterIncidents);

    incidentDateFilter.addEventListener('change', filterIncidents);

    resetButton.addEventListener('click', () => {
        locationSearch.value = '';
        crimeTypeFilter.value = 'all';
        riskLevelFilter.value = 'all';
        incidentDateFilter.value = '';

        filterIncidents();

        locationSearch.focus();
    });

    /*
    |--------------------------------------------------------------------------
    | View Details Buttons
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('[data-view-incident]')
        .forEach((button) => {
            button.addEventListener('click', () => {
                const incidentId = button.dataset.viewIncident;

                openIncidentModal(incidentId);
            });
        });

    /*
    |--------------------------------------------------------------------------
    | Close Modal Buttons / Backdrop
    |--------------------------------------------------------------------------
    */

    closeModalButtons.forEach((button) => {
        button.addEventListener('click', () => {
            closeIncidentModal();
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Escape Key
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', (event) => {
        if (
            event.key === 'Escape' &&
            incidentModal?.classList.contains('is-open')
        ) {
            closeIncidentModal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Initial State
    |--------------------------------------------------------------------------
    */

    filterIncidents();
});
