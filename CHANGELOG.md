# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.7.2]

### Fixed

- Mail-provider delivery webhooks work again on a gated site. 2.7.0's REST gate answered them with 401, so Mailjet flagged `staging.voget.co`'s WP Mail SMTP webhook as failing. Requests to `wp-mail-smtp/v1/webhooks/…` now pass the gate (WP Mail SMTP Pro registers only the active mailer's route and validates it itself). Everything else under `/wp-json/` stays closed to visitors. More route prefixes can be added with the `bouncer_open_rest_routes` filter.

## [2.7.1]

### Fixed

- A gated site still gave away login names and post slugs. WordPress's canonical redirect ran before the gate, so `?author=1` got a 301 to `/author/<login>/` and `?p=N` a 301 to the post's slug. The gate now runs first (`template_redirect` priority 1).
- The gate page served for `/feed/` was labelled `application/rss+xml`. It now always sends `text/html`.

## [2.7.0]

### Added

- While the gate is on, `xmlrpc.php` answers 403 for everyone. The check runs as soon as the plugin file loads, before the theme, later plugins and any login attempt. Before this, a gated site still accepted XML-RPC login attempts.
- While the gate is on, the REST API (`/wp-json/` and `?rest_route=`) answers 401 to visitors who are not logged in. Before this, it served the gated site's posts, pages and user list. Logged-in users, application passwords, allowed IPs and preview-link holders keep access.
- Access tab: "APIs While Closed" with two opt-outs, "Keep the REST API open for everyone" and "Keep XML-RPC open" (options `bouncer_allow_rest`, `bouncer_allow_xmlrpc`).
- Upgrading from Bouncer 1.0.0: its page text (`bouncer_text`) is copied to Main Text once, so the page keeps its wording.

### Changed

- While the gate is on and XML-RPC is closed, the `X-Pingback` header is no longer sent.
- Access tab: when the IP WordPress sees is a private or internal address (a proxy or container gateway), Bouncer shows a warning and hides "Add to list". Allowing that address would let everyone behind the proxy past the gate.
- `BOUNCER_VERSION` now comes from the class constant, so the version lives in two places (header and `VERSION`).

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
