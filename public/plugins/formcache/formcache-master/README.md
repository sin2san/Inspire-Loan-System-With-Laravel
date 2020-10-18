# [Form Cache](https://github.com/fengyuanchen/formcache)

A simple jQuery form cache plugin.

- [Demo](http://fengyuanchen.github.io/formcache)


# Getting started

## Quick start

Three quick start options are available:

- [Download the latest release](https://github.com/fengyuanchen/formcache/archive/master.zip).
- Clone the repository: `git clone https://github.com/fengyuanchen/formcache.git`.
- Install with [NPM](http://npmjs.org): `npm install formcache`.


## Installation

Include files:

```html
<script src="/path/to/jquery.js"></script><!-- jQuery is required -->
<script src="/path/to/formcache.js"></script>
```


## Usage

### Initializes with `data-toggle="formcache"` attribute

```html
<form data-toggle="formcache"></form>
```

### Initializes with `$.fn.formcache` method

```html
<form id="form"></form>
```

```javascript
$('#form').formcache()
```


## Options

#### key

- Type: `String` | `Number`
- Default: `''`

A special identification for the form cache, must be different to other forms in the same page.

By default, the form's index in the document will be used as the `key`.


#### local

- Type: `Boolean`
- Default: `true`

Store cache in localStorage.


#### session

- Type: `Boolean`
- Default: `true`

Store cache in sessionStorage.


#### autoStore

- Type: `Boolean`
- Default: `true`

Update and store the cache automatically when a form control changed or before page unload.


#### maxAge

- Type: `Number`
- Default: `undefined`

set the stored time (in seconds) of the caches, just like the `max-age` for `cookie`.

By default, the session caches will be cleared when the browser closes, and the local caches will be stored all the time.

**Notes**:
- session caches still will be cleared when the browser closes.
- local caches still will be cleared when the browser caches clears.


#### controls

- Type: `Array`
- Default:
```javascript
[
  'select',
  'textarea',
  'input'
]
```

A jQuery selectors array. Defines the form controls which need to be cached.

**Note:** All file inputs will be ignored always by default.



## Methods

#### getCache([index])

Params | Type | Default | Description
------ | ---- | ------- | -----------
index | `Number` | `0` | Cache index

Get the default cache object or a special one.

**Examples:**

```
$().formcache('getCache')
$().formcache('getCache', 1)
```


#### getCaches()

Get all cache objects.

**Examples:**

```
$().formcache('getCaches')
```


#### setCache([index, ]data)

Params | Type | Default | Description
------ | ---- | ------- | -----------
index | `Number` | `0` | Cache index
data  | `Object` |     | Cache item

Override the default cache object or add a new one.

**Examples:**

```
$().formcache('setCache', {})
$().formcache('setCache', 1, {})
```


#### setCaches(data)

Params | Type | Description
------ | ---- | -----------
data | `Array` | Cache items

Override the old caches with new caches.

**Examples:**

```
$().formcache('setCaches', [{}])
$().formcache('setCaches', [{}, {}])
```


#### removeCache([index])

Params | Type | Default | Description
------ | ---- | ------- | -----------
index | `Number` | `0` | Cache index

Remove the default cache object or a special one.

**Examples:**

```
$().formcache('removeCache')
$().formcache('removeCache', 1)
```


#### removeCaches()

Remove all cache objects.

**Examples:**

```
$().formcache('removeCaches')
```


#### outputCache([index])

Params | Type | Default | Description
------ | ---- | ------- | -----------
index | `Number` | `0` | Cache index

Output the default cache object or a special one to the form.

The outputed cache object will be updated automatically when any form control changed.

**Examples:**

```
$().formcache('outputCache')
$().formcache('outputCache', 1)
```

#### serialize()

Serialize the form and return a cache object.

**Examples:**

```
var cache = $('form').formcache('serialize');

$('form').formcache('setCache', cache);
$('form').formcache('setCaches', [cache, cache]);
```


#### store()

Store all caches to sessionStorage or localStorage.

The plugin will do this automatically when a form control changed, or the window unloaded.


#### clear()

Clear all caches.


#### destroy()

Destroy the formcache instance, but keep the caches.

If you want to remove all caches, you can call `clear` method first and then call this method.


## Browser Support

- Chrome 31+
- Firefox 31+
- Internet Explorer 8+
- Opera 26+
- Safari 5.1+
- iOS Safari 7.1+
- Android Browser 4.1+
- Chrome for Android 39+

As a jQuery plugin, you can reference to the [jQuery Browser Support](http://jquery.com/browser-support/).


## [License](https://github.com/fengyuanchen/formcache/blob/master/LICENSE.md)

Released under the [MIT](http://opensource.org/licenses/mit-license.html) license.
