# Bouncer

Maintenance mode and coming soon pages for WordPress, done the way search engines expect.

![License: GPL v2 or later](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)
![WordPress 6.6+](https://img.shields.io/badge/WordPress-6.6%2B-21759b)
![PHP 8.1+](https://img.shields.io/badge/PHP-8.1%2B-777bb4)

<!-- Screenshots: settings page and the visitor-facing page. Add images to /.github/ and link them here. -->

## Why Bouncer

Most maintenance plugins show a pretty page and stop there. Bouncer also gets the HTTP side right:

- **Maintenance Mode** answers with `503 Service Unavailable` and a `Retry-After` header, so search engines keep your existing rankings and come back later.
- **Coming Soon** answers with `200`, for a site that hasn't launched yet.
- **Nothing gets indexed while the gate is on.** In both modes Bouncer serves a strict `robots.txt` (`Disallow: /`), sends `X-Robots-Tag: noindex, nofollow` and adds a `noindex` meta tag.
- **When Bouncer is off, it stays out of the way.** `robots.txt` and SEO go back to WordPress or your SEO plugin.

And it makes it easy to show the site to clients before launch:

- **Named preview links.** One link per person or team, each with its own expiry, open count and last-opened time.
- **IP allowlist** for your office or agency network.
- Logged-in users always see the live site.

## Features

- Two modes: Maintenance (503) and Coming Soon (200)
- Configurable `Retry-After` interval
- Named preview links
  - Durations per link: 1h / 6h / 24h / 3d / 7d / 30d / no expiry
  - **Deactivate** cuts access immediately and keeps the link in the list for your records
  - **Delete** removes the link and its stats permanently
- IP allowlist
- Admin bar indicator with one-click on/off
- Editable heading, main text, optional secondary text (bilingual sites, short summaries) and contact email
- Contact email is obfuscated in the HTML source to deter spam harvesters
- Optional dark mode toggle and website button on the visitor page
- No account, no tracking, no upsells

## Requirements

- WordPress 6.6 or later
- PHP 8.1 or later

## Installation

1. Download the latest `bouncer.zip` from [Releases](https://github.com/mvgt13/bouncer/releases), or copy the `bouncer/` folder from this repository.
2. In WordPress, go to **Plugins → Add New → Upload Plugin** and upload the zip, or put the `bouncer/` folder into `wp-content/plugins/`.
3. Activate **Bouncer** under **Plugins**.
4. Configure it under **Settings → Bouncer**.

Bouncer does not update itself from wordpress.org (`Update URI: false`). To update, replace the plugin folder with a newer release.

## Settings

### Status

| Option | Description |
|---|---|
| Enable Bouncer | Gate the front end. While on, only logged-in users, allowed IPs and preview-link holders reach the live site. A strict `robots.txt` and `noindex` headers are served. |
| Mode | Maintenance (503, for an existing indexed site that is temporarily down) or Coming Soon (200, for a site that hasn't launched yet). Neither is indexable while gated. |
| Retry After | `Retry-After` value on the 503: a hint for how long search engines should wait before checking again. Maintenance mode only. |

### Access Control

| Option | Description |
|---|---|
| New Link Duration | How long newly created links stay active: 1h, 6h, 24h, 3d, 7d, 30d or no expiry. Does not affect existing links. |
| Preview Links | Table of all named preview links. Create, copy, deactivate or delete individual links. |
| Allowed IPs | One IP per line. These visitors always see the live site, whatever the Bouncer status. |

**Link status**

- **Active** (green): the link is valid and has been opened at least once
- **Active, not opened yet** (grey): the link is valid but nobody has used it yet
- **Expired** (yellow): the link passed its expiry date
- **Deactivated** (grey): an admin deactivated the link

**Notes**

- "No expiry" links set browser cookies capped at 14 days, so no visitor keeps permanent access by cookie. The link itself stays valid until you deactivate or delete it.
- The open counter only counts a visitor's first arrival (without a valid cookie), so page refreshes don't inflate it.

### Content

| Option | Description |
|---|---|
| Heading | Large display text |
| Main Text | Body copy shown to all visitors |
| Secondary Text | Optional second text block below the main text, for bilingual sites, short summaries or extra copy |
| Contact Email | Linked in the page copy and obfuscated in the HTML source. Leave blank to omit it. |

### Display

| Option | Description |
|---|---|
| Dark Mode Toggle | Show a dark/light mode switch |
| Website Button | Show a button linking to an external URL |
| Website URL | Target URL for the website button |

## Files

```
bouncer/
  bouncer.php            # Plugin entry point, admin UI, bypass logic
  bouncer-template.php   # Visitor-facing page template
  uninstall.php          # Removes all bouncer_* options when the plugin is deleted
```

## Changelog

See [CHANGELOG.md](CHANGELOG.md).

## License

Bouncer is free software, licensed under the [GNU General Public License v2.0 or later](LICENSE).

Made by [VOGET.CO](https://voget.co).
