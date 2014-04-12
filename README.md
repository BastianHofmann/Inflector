Inflector
=========

A package to transform english words from singular to plural and back.

## Usage

```php
Inflector\Inflector::plural('Tree'); // Trees

Inflector\Inflector::singular('Cakes'); // Cake

Inflector\Inflector::plural('Fish'); // Fish
```

Providers may be used to retrieve uncommon irregular words.

```php
Inflector\Inflector::setProvider(new Inflector\JsonProvider);
```

Providers must implement the `Inflector\ProviderInterface`.
