# Google Maps Searchbox (PHP Core)

A PHP + MySQL example application for managing and displaying location markers on Google Maps. Locations are stored in a database and rendered as map markers with info windows, and the project includes a location search box and an admin form for adding new locations.

## Tech Stack

- **PHP** with **MySQLi** (database access)
- **MySQL** (`map_location` database, `locations` table)
- **Google Maps JavaScript API**
- **HTML / CSS** with **Bootstrap 4** and **jQuery**

## Features

- Store location records (name, info, latitude, longitude) in MySQL.
- Display all saved locations as **markers on a Google Map** with info windows.
- **Add Location** form to insert new map points into the database.
- **Search by zip code / location** input box.
- Custom marker pin image (`pin.png`).

## Requirements

- PHP with the **MySQLi** extension
- MySQL / MariaDB
- A web server (Apache / XAMPP recommended)
- A **Google Maps JavaScript API key**

## Installation & Setup

1. Copy the `googlemap` folder into your web server document root (e.g. `htdocs/` under XAMPP).
2. Create a MySQL database named `map_location` with a `locations` table (columns such as `id`, `name`, `info`, `lat`, `lng`, `icon`).
3. Update the database credentials in `googlemap/config.php` if your MySQL setup differs from the default (`localhost` / `root` / no password).
4. Add your Google Maps API key in the map page where the Maps script is loaded.
5. Start Apache and open the project in your browser.

## Usage

- `googlemap/map.php` — view all stored locations on the map.
- `googlemap/add_loc.php` — add a new location via a form (posts to `add_loc_api.php`).
- `googlemap/search_loc.php` — search for a location.
- `googlemap/location.php` — list of saved locations.

## Project Structure

```
googlemap/config.php        MySQLi database connection
googlemap/map.php           Renders the map and markers from the database
googlemap/add_loc.php       Add-location form
googlemap/add_loc_api.php   Handles the insert
googlemap/search_loc.php    Location search box
googlemap/location.php      Location listing
googlemap/pin.png           Custom marker icon
```

## License

This project is for educational/portfolio purposes.
