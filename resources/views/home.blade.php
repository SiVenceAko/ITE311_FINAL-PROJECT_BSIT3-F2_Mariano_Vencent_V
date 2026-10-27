<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Victoria City Crime Mapping System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header>
        <h1>Victoria City Crime Mapping System</h1>

        <nav>
            <a href="#">Home</a>
            <a href="#">Crime Map</a>
            <a href="#">Reports</a>
            <a href="#">Analytics</a>
        </nav>
    </header>

    <main>
        <section>
            <p>Victoria City Public Safety</p>

            <h2>Know Your City. Understand Your Safety.</h2>

            <p>
                Explore crime incidents, identify high-risk areas, and understand
                neighborhood safety trends across Victoria City.
            </p>

            <a href="#">Explore Crime Map</a>
            <a href="#">View Safety Overview</a>
        </section>

        <section>
            <h2>Crime Overview</h2>

            <div>
                <article>
                    <h3>124</h3>
                    <p>Total Reports</p>
                </article>

                <article>
                    <h3>18</h3>
                    <p>Reports This Month</p>
                </article>

                <article>
                    <h3>7</h3>
                    <p>High-Risk Areas</p>
                </article>

                <article>
                    <h3>12</h3>
                    <p>Areas Monitored</p>
                </article>
            </div>
        </section>

        <section>
            <h2>Explore Safety Features</h2>

            <article>
                <h3>Interactive Crime Map</h3>
                <p>
                    Explore reported incidents across Victoria City through
                    an interactive map.
                </p>
            </article>

            <article>
                <h3>Crime Heatmaps</h3>
                <p>
                    Quickly identify areas with higher concentrations of
                    reported incidents.
                </p>
            </article>

            <article>
                <h3>Safety Trends</h3>
                <p>
                    Understand crime patterns and neighborhood safety trends
                    through visual analytics.
                </p>
            </article>
        </section>
    </main>

    <footer>
        <p>
            &copy; {{ date('Y') }} Victoria City Crime Mapping System
        </p>
    </footer>

</body>
</html>
