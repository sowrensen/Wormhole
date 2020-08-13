# Wormhole

Changelog
---

##### Release 2.x

- Method signature changed for all methods.
- No need to provide whole `$request` object anymore, only pass the file to save, which ensures complete abstraction.
- Added unit tests.

##### Release 1.x

- Initial release (v1.0.0)
- Absence of input field doesn't throw error anymore, instead returns an empty string. (v1.0.1)
