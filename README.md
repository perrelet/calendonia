# Caledonia

Bringing all the events into one place.

## Installation

```
git clone https://github.com/perrelet/calendonia.git
cd calendonia
composer update
php artisan migrate
php artisan db:seed
php artisan make:filament-user
```

## Embedding

| Parameter | Type | Description | Default |
| - | - | - | - |
| `template` | string | The view to use when rendering (`simple`, `directory`, `grid` or `hub`). | `'simple'` |
| `tense` | string | Dates to display. (`all`, `future` or `past`). |  `'future'` |
| `offset` | int | Number of events to skip. | `null` |
| `n` | int | Total number of events to show. | `null` |
| `group` | datetime format | How events should be grouped. Accepts a [PHP DateTime format](https://www.php.net/manual/en/datetime.format.php) | `'F Y'` |
| `ppp` | int | Number of events per page. | `12` |
| `reverse` | bool | Whether to reverse event order. | `null` |
| `tags` | string | Only show events with **one or more** of the given tags. (Accepts a comma seperated list). | `null` |
| `xtags` | string | Only show events with **none** of the given tags. (Accepts a comma seperated list). | `null` |