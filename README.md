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
| `group` | string | Group events by date, accepts a valid [PHP DateTime format](https://www.php.net/manual/en/datetime.format.php). | `'F Y'` |
| `ppp` | int | Number of events per page. | `12` |
| `reverse` | bool | Whether to reverse event order. | `null` |
| `tags` | string | Only show events with **one or more** of the given tags. (Accepts a comma seperated list). | `null` |
| `xtags` | string | Only show events with **none** of the given tags. (Accepts a comma seperated list). | `null` |

## Embedding

| Parameter | Type | Description | Default |
| - | - | - | - |
| `template` | string | View to render (`simple`, `directory`, `grid`, `hub`, `calendar` or `fullcal`). | `'simple'` |
| `start` | string | Get dates after. | `null` |
| `end` | string | Get dates before. | `null` |
| `tense` | string | Dates to display. (`all`, `future` or `past`). |  `'future'` |
| `timezone` | string | Timezone to diplay dates in, accepts a valid [PHP timezone](https://www.php.net/manual/en/timezones.php). |  `'Europe/London'` |
| `order` | string | Date order. Default's to `'ASC'` for future and `'DESC'` for past tense. |  `null` |
| `offset` | int | Number of events to skip. | `null` |
| `n` | int | Total number of events to show. | `null` |
| `group` | string | Group events by date, accepts a valid [PHP DateTime format](https://www.php.net/manual/en/datetime.format.php). | `'F Y'` |
| `ppp` | int | Number of events per page. | `12` |
| `type` | string | Filters events by type. | `null` |
| `tags` | string | Only show events with **one or more** of the given tags. (Accepts a comma seperated list). | `null` |
| `xtags` | string | Only show events with **none** of the given tags. (Accepts a comma seperated list). | `null` |
| `ui` | bool | Display UI controls. | `true` |
| `ui_type` | bool | Display type UI filter. | `true` |
| `ui_tags` | bool | Display tags UI filter. | `false` |