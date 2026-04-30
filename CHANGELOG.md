## Unreleased

[FIX] `List.html`: drop duplicate `f:asset.script` / `<link>` CSS for Swiper and natural-carousel when `<carousel:loadAssets/>` already registers them (VHS / PageRenderer) — double script run caused duplicate `.swiper-pagination` blocks.
[FIX] `natural-carousel.min.js`: before building DOM, `destroy()` + `empty()` on re-init (belt-and-suspenders if assets load twice).
[FIX] Remove `//# sourceMappingURL=maps/swiper.jquery.min.js.map` from `swiper.jquery.min.js` (map not shipped; VHS bundle resolves relative URL → 404 in DevTools).
[FIX] `natural-carousel.min.js`: skip Swiper when there are no slides; turn off `loop` when fewer than two slides; harden `paginationBulletRender` (Swiper 3 loop can pass more bullet indices than the data `slides` array — avoids `t.slides[a] is undefined` / missing `thumbnail`).
[FIX] Register backend icon from `Resources/Public/Icons/ext_icon.png` so Composer installs do not hit `InvalidFileException` for `EXT:.../ext_icon.png` outside the public web path.
[FIX] Register `list_type` plugin via `ExtensionUtility::registerPlugin()` so the backend shows title/description instead of `MISSING LABEL ("naturalcarousel_pi1")`.
[FIX] TYPO3 v13: move `tt_content` plugin / `pi_flexform` registration from `ext_tables.php` to `Configuration/TCA/Overrides/tt_content.php` (core requires Overrides for correct flex + FAL save).
[FIX] FlexForm: drop `meta/langDisable` (can disturb `vDEF` handling); use minimal `type=file` like `tt_content.image` (`allowed=common-image-types`, appearance only).
[FIX] Controller still resolves numeric `sys_file_reference` uids from `pi_flexform` when `findByRelation` is empty.

## 4.0.0 (2025-11-27)

[TASK] TYPO3 v12 + v13 compatibility

## 3.0.3 (2022-07-01)

[FIX] Image selection in backend

## 3.0.2 (2022-06-29)

[FIX] Base url

## 3.0.1 (2022-06-29)

[FIX] Add base url
[TASK] Composer validate
[TASK] Add changelog

## 3.0.0 (2022-06-17)

[FIX] TYPO3 compatibility
[REFACTOR] TYPO3 v11 compatibility
[TASK] Prepare next release