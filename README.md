# Doublespark Contao Custom Login

A custom login page for the backend, branded with Doublespark or TitmanFirth branding.

## Settings
The settings can be found under Contao's "Settings" page in the CMS. The following options are available:

| Field                | Description                                |
|:---------------------|:-------------------------------------------|
|Login theme           | Sets the theme of the login page           |
|Messages endpoint URL | The URL where messages can be fetched from |

## Developer notes

### Login page modifications

**Step 1:** Add the common stylesheet `/bundles/doublesparkcontaocustomlogin/css/common.css`

**Step 2:** Add the theme stylesheet, the path is in the following variable `$this->loginTheme`

**Step 3:** Add the following snippet to the `<head>` for the pop-up functionality:
```html
<!-- Custom login popup -->
<script>window.popupUrl = '<?= $this->popupUrl; ?>';window.popupLink = '<?= $this->popupLink; ?>';</script>
<link rel="stylesheet" href="/bundles/doublesparkcontaocustomlogin/css/popup.css">
```

**Step 4:** Add the following snippet to the end of the `<body>`:
```html
<!-- Custom login JS -->
<script src="/bundles/doublesparkcontaocustomlogin/js/cookies.js"></script>
<script src="/bundles/doublesparkcontaocustomlogin/js/popup.js"></script>
<script src="/bundles/doublesparkcontaocustomlogin/js/messages.js"></script>
```

**Step 5:** Add the following code snippet below the `<form>` in order to output the custom messages:
```php
<?php if($this->arrMessages): ?>
    <div class="messages-wrapper">
        <?php foreach($this->arrMessages as $message): ?>
        <div id="message-<?= $message['id']; ?>" data-mid="<?= $message['id']; ?>" class="message">
            <button class="close-button">Dismiss X</button>
            <?= $message['messageText']; ?>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
```

**Step 6:** Add the following code to output the stickied messages:
```php
<?php if($this->arrStickyMessages): ?>
  <div class="sticky-messages-wrapper">
      <?php foreach($this->arrStickyMessages as $message): ?>
          <div class="message">
              <?= $message['messageText']; ?>
          </div>
      <?php endforeach; ?>
  </div>
<?php endif; ?>
```
