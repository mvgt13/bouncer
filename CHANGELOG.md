# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.6.0]

### Added

- Settings page split into four tabs: Status, Access, Content and Display. The active tab stays open after Save Changes and after creating or deleting a preview link.
- Status notice at the top of the settings page: on or off, and what visitors see.
- Access tab shows the current IP as WordPress sees it, with an "Add to list" button for Allowed IPs.
- A short intro line on each tab, and a note that preview link changes apply without Save Changes.

### Changed

- The Retry After row is only shown in Maintenance mode.

- Renamed from "WP Bouncer" to "Bouncer" in all docs; the plugin header already used "Bouncer". The repository moves to `mvgt13/bouncer`.
- Plugin header: new description, `Plugin URI` points to the GitHub repository, added `License: GPL-2.0-or-later` and `License URI`.
- `LICENSE` now holds the unmodified GPL v2 text so GitHub detects the license. The "or later" grant is stated in the plugin header and README.
- README rewritten for public readers.

## [2.5.6]

### Fixed

- A gated site could still be indexed: on `template_redirect` Bouncer swallowed WordPress's `do_robots()`, so `/robots.txt` returned the HTML placeholder (indexable, HTTP 200 in Coming Soon mode) and the site had no valid robots.txt. Bouncer now serves a real `robots.txt` (`User-agent: * / Disallow: /`, `text/plain`) while the gate is on.

### Added

- Every gated response now carries an `X-Robots-Tag: noindex, nofollow` header (both modes), and the Bouncer page includes a `<meta name="robots" content="noindex, nofollow">` tag.

### Changed

- Expanded the inline help text on the settings page (Enable, Mode, Retry After, Allowed IPs, Heading, Main Text, Contact Email, Display options).
- When Bouncer is disabled it does not touch `is_robots()` or send any headers — `robots.txt` and SEO are left entirely to WordPress / the site's SEO plugin.

## [2.5.5]

### Changed

- Contact email on the Bouncer page is now obfuscated in the HTML source (reversed + base64 in a data attribute, rehydrated to a `mailto:` link by an inline script) so address-harvesting spam bots can't scrape it. No-JS visitors get a readable `user [at] host` fallback.

## [2.5.4]

### Added

- Initial public release of WP Bouncer.
- Maintenance Mode and Coming Soon modes with correct HTTP `503` and `200` responses.
- Configurable `Retry-After` header support for maintenance mode.
- Logged-in user bypass so site administrators can access the live site while Bouncer is enabled.
- IP allowlist support for trusted visitors.
- Named preview links with per-link expiry, activation state, usage counts, and last-used timestamps.
- Per-link management actions to create, copy, deactivate, and delete preview links.
- Admin bar status indicator with one-click enable and disable controls.
- Configurable visitor-facing content including heading, main text, optional secondary text, and contact email.
- Optional dark mode toggle and external website button on the Bouncer page.
- REST endpoint for deleting all revisions for a post.
- Legacy single-token migration into the current multi-token preview-link system.
