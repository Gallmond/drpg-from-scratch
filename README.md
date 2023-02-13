# Notes

Had major trouble getting PHP7.2 and Laravel 6 working on work machine so spun up a fresh new one instead.

Issues of note:
- This does an insert-per-user. For actual scheduled jobs I'd do these as batch inserts
- This uses mock API responses (which is what I'd do in real life anyway). This can be turned off by commenting-out the call to `mockApiCalls` in `\Tests\TestCase::setUp`
