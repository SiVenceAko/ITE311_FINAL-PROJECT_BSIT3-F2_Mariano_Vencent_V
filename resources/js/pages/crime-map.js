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

    const incidentMarkers = [
        ...document.querySelectorAll('[data-marker-id]'),
    ];

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
                `${count} sample ${count === 1 ? 'record' : 'records'}`;
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
            `Sample Incident #${incident.dataset.id}`;

        modalIncidentType.textContent =
            formatText(incident.dataset.type);

        modalIncidentLocation.textContent =
            formatText(incident.dataset.location);

        modalIncidentDate.textContent =
            formatIncidentDate(incident.dataset.date);

        modalIncidentRisk.textContent =
            formatRiskLevel(incident.dataset.risk);

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
    | Map Markers
    |--------------------------------------------------------------------------
    */

    incidentMarkers.forEach((marker) => {
        marker.addEventListener('click', () => {
            const incidentId = marker.dataset.markerId;

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
