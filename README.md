# Victoria Crime Mapping System

## Student Information

**Student Name:** Vencent V. Mariano & Ed Mark Macauyam.
**Course and Section:** ITE311 - BSIT 3-F2

## Project Description

The Victoria Crime Mapping System is a Laravel web application for submitting and reviewing reported incidents in Victoria, Oriental Mindoro. Public reports are saved as pending and are excluded from the public map and analytics until staff review and approve them. Approved incidents can be plotted on the map when they have valid coordinates.

## Technologies Used

- Laravel
- PHP 8.3 or later
- MySQL
- HTML
- CSS
- JavaScript, Vite, and Leaflet
- OpenStreetMap tiles
- Git
- GitHub

## Project Features

- Public incident-report form with incident type, date, description, optional barangay, and map-based location selection.
- Server-side validation of report fields and coordinates; submissions are limited to five per minute per IP.
- Pending reports are hidden from public pages until approved by staff.
- Interactive OpenStreetMap centered on Victoria, Oriental Mindoro, with risk-colored markers for approved incidents that have coordinates.
- Crime-map filters for location, type, risk level, and incident date; incident details can be opened from the list or a map marker.
- Analytics for approved incident totals, risk levels, crime-type distribution, latest dated activity, and barangay comparisons.
- Responsive interface for desktop and mobile screens.

## Requirements

- PHP 8.3 or later and Composer
- Node.js and npm
- MySQL (Laragon can provide the local web server and database)
- Internet access for OpenStreetMap tiles

## Setup

1. Start MySQL in Laragon.
2. Open PowerShell in the project directory and install dependencies:

   ```powershell
   composer install
   npm install
   ```

3. If `.env` does not exist yet, create it from the example:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Create the MySQL database in phpMyAdmin if it does not exist yet, then configure the `DB_*` values in `.env` to match it. Generate an application key if `APP_KEY` is empty:

   ```powershell
   php artisan key:generate
   ```

5. Apply database migrations. This creates or updates the required tables without resetting the database:

   ```powershell
   php artisan migrate
   ```

   If the default `php` on Windows points to an older version, use your PHP 8.3 executable for Artisan commands, for example:

   ```powershell
   & 'C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe' artisan migrate
   ```

## Run Locally

Open two PowerShell terminals in the project directory:

1. Start Laravel:

   ```powershell
   php artisan serve
   ```

   If needed, use the PHP 8.3 executable path shown in Setup instead of `php`.

2. Start the Vite development server:

   ```powershell
   npm run dev
   ```

Keep both terminals running. Open these pages in a browser:

- Home: `http://127.0.0.1:8000/`
- Crime map: `http://127.0.0.1:8000/crime-map`
- Analytics: `http://127.0.0.1:8000/analytics`
- Submit a report: `http://127.0.0.1:8000/report-crime`

To build frontend assets for use without the Vite development server, run `npm run build`.

## Review Public Reports

There is currently no staff login or admin review screen. An authorized staff member must review reports in phpMyAdmin (or another trusted database client). Inspect pending reports first:

```sql
SELECT id, type, description, date, barangay_id, latitude, longitude, status
FROM crimes
WHERE status = 'pending'
ORDER BY id;
```

After independently verifying a report and its location, approve only that specific report and set its risk level:

```sql
UPDATE crimes
SET status = 'approved', risk_level = 'moderate'
WHERE id = 1 AND status = 'pending';
```

Replace `1` with the reviewed report ID and choose `high`, `moderate`, or `monitored` as appropriate. Do not approve unverified submissions. The report form does not collect a name or contact details and is not an emergency service. Avoid entering identifying or sensitive personal information in report descriptions.

## Tests

Run the automated test suite with:

```powershell
php artisan test
```