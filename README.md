# RSS Feed Maker

Create RSS feeds easily in PHP!

This library allows you to create an XML file representing an RSS feed.


## Requirement

* PHP 7.4+


## Installation

With Composer, run this command:

    composer require shevabam/rss-feed-maker


## Usage

First, include the library in your code using the Composer autoloader and then create a Feed object.

```php
require 'vendor/autoload.php';

$feed = new \RssFeedMaker\Feed;
```

Next, configure the feed: 

```php
$feed
    ->setTitle('RSS Feed Title')
    ->setDescription('Recent articles on my website')
    ->setLink('https://website.com')
    ->setCopyright('MyWebsite.com')
    ->setLanguage('en')
    ->setImage([
        'title' => 'Image title', 
        'url' => 'https://website.com/Image.jpg', 
        'link' => 'https://website.com', 
    ])
;
```


Here are the parameters that can be modified for the feed:

| RSS Tag       | PHP method         | Example                                                                                                                           | Default     | Required |
|---------------|--------------------|-----------------------------------------------------------------------------------------------------------------------------------|-------------|----------|
| `title`         | setTitle()         | $feed->setTitle('RSS Feed Title');                                                                                                | Empty       | Yes      |
| `description`   | setDescription()   | $feed->setDescription('Recent articles on your website');                                                                         | Empty       | Yes      |
| `lastBuildDate` | setLastBuildDate() | $feed->setLastBuildDate();                                                                                                        | Actual date |          |
| `pubDate`       | setPubDate()       | $feed->setPubDate();                                                                                                              | Empty       |          |
| `link`          | setLink()          | $feed->setLink('https://website.com');                                                                                            | Empty       | Yes      |
| `webMaster`     | setWebmaster()     | $feed->setWebmaster('John Doe');                                                                                                  | Empty       |          |
| `category`      | setCategory()      | $feed->setCategory('Blog');                                                                                                       | Empty       |          |
| `copyright`     | setCopyright()     | $feed->setCopyright('MyWebsite.com');                                                                                             | Empty       |          |
| `language`      | setLanguage()      | $feed->setLanguage('en');                                                                                                         | en          |          |
| `ttl`           | setTtl()           | $feed->setTtl(30);                                                                                                                | Empty       |          |
| `image`         | setImage()         | $feed->setImage([   'title' => 'Image title',    'url' => 'https://website.com/Image.jpg',    'link' => 'https://website.com' ]); | Empty       |          |



The `language` code is described here: [https://www.rssboard.org/rss-language-codes](https://www.rssboard.org/rss-language-codes)

Default encoding is: utf-8. You can change it with:

```php
$feed->setEncoding('iso-8859-1');
```


Then, create the items and inject them into the feed:

```php
$posts = [
    [
        'title' => 'Post title #1',
        'link' => 'https://website.com/1-post-title',
        'published_at' => '2023-03-18 12:00:00',
        'description' => 'Blog post about something very important',
    ],
    [
        'title' => 'Post title #2',
        'link' => 'https://website.com/2-post-title',
        'published_at' => '2023-03-11 16:30:00',
        'description' => 'Blog post about something very important',
    ],
];

foreach ($posts as $post)
{
    $item = new \RssFeedMaker\Item;

    $item
        ->setTitle($post['title'])
        ->setLink($post['link'])
        ->setDescription($post['description'])
        ->setPubDate($post['published_at'])
    ;
    
    $feed->addItem($item);
}
```

Parameters for item:

| RSS Tag     | PHP method       | Example                                                                                                                          | Default | Required |
|-------------|------------------|----------------------------------------------------------------------------------------------------------------------------------|---------|----------|
| title       | setTitle()       | $item->setTitle('Blog post #1');                                                                                                 | Empty   | Yes      |
| description | setDescription() | $item->setDescription('Post content blabla');                                                                                    | Empty   | Yes      |
| pubDate     | setPubDate()     | $item->setPubDate();                                                                                                             | Empty   |          |
| link        | setLink()        | $item->setLink('https://website.com/post-1');                                                                                    | Empty   | Yes      |
| author      | setAuthor()      | $item->setAuthor('John Doe');                                                                                                    | Empty   |          |
| category    | setCategory()    | $item->setCategory('Tutorials');                                                                                                 | Empty   |          |
| guid        | setGuid()        | $item->setGuid('https://website.com/...');                                                                                       | Empty   |          |
| comments    | setComments()    | $item->setComments('https://website.com/post-1/comments');                                                                       | Empty   |          |
| source      | setSource()      | $item->setSource([   'url' => 'https://wikipedia...',   'source' => 'Description', ]);                                           | Empty   |          |
| enclosure   | setEnclosure()   | $item->setEnclosure([   'url' => 'https://website.com/podcasts/example.mp3',   'length' => 12345,    'type' => 'audio/mpeg', ]); | Empty   |          |


For more information about the RSS schema, please see the [specifications](https://www.rssboard.org/rss-specification).


Finally, generate the XML with:

```php
echo $feed->generate();
```

You can save the RSS feed to a file:

```php
$feed->save('path/to/the/feed.xml');
```



## Full example

```php
require 'vendor/autoload.php';

$feed = new \RssFeedMaker\Feed;

$feed
    ->setTitle('RSS Feed Title')
    ->setDescription('Recent articles on your website')
    ->setLink('https://website.com')
    ->setCopyright('MyWebsite.com')
    ->setImage([
        'title' => 'Image title', 
        'url' => 'https://website.com/Image.jpg', 
        'link' => 'https://website.com', 
    ])
;

$posts = [
    [
        'title' => 'Post title #1',
        'link' => 'https://website.com/1-post-title',
        'published_at' => '2023-03-14 12:00:00',
        'author' => 'John Doe',
        'description' => 'Blog post about something very important',
    ],
    [
        'title' => 'Post title #2',
        'link' => 'https://website.com/2-post-title',
        'published_at' => '2023-03-08 16:30:00',
        'author' => 'Jane Doe',
        'description' => 'Blog post number two',
    ],
    [
        'title' => 'Post title #3',
        'link' => 'https://website.com/3-post-title',
        'published_at' => '2023-03-01 08:45:00',
        'enclosure' => [
            'url' => 'https://website.com/podcasts/example.mp3',
            'length' => 12345,
            'type' => 'audio/mpeg',
        ],
    ],
];

foreach ($posts as $post)
{
    $item = new \RssFeedMaker\Item;

    $item->setTitle($post['title']);
    $item->setLink($post['link']);
    $item->setDescription(isset($post['description']) ? $post['description'] : '');
    $item->setPubDate(isset($post['published_at']) ? $post['published_at'] : '');
    $item->setAuthor(isset($post['author']) ? $post['author'] : '');
    $item->setCategory(isset($post['category']) ? $post['category'] : '');
    $item->setGuid(isset($post['guid']) ? $post['guid'] : '');
    $item->setSource(isset($post['source']) ? $post['source'] : []);
    $item->setEnclosure(isset($post['enclosure']) ? $post['enclosure'] : []);
    
    $feed->addItem($item);
}

$feed->save('public/feed.xml');
```

Result:

```xml
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
    <title>RSS Feed Title</title>
    <link>https://website.com</link>
    <description>Recent articles on your website</description>
    <language>en</language>
    <lastBuildDate>Tue, 28 Mar 2023 19:45:47 +0200</lastBuildDate>
    <copyright>MyWebsite.com</copyright>
    <image>
      <title>Image title</title>
      <url>https://website.com/Image.jpg</url>
      <link>https://website.com</link>
    </image>
    <item>
      <title>
        <![CDATA[Post title #1]]>
      </title>
      <link>https://website.com/1-post-title</link>
      <description>
        <![CDATA[Blog post about something very important]]>
      </description>
      <pubDate>Tue, 14 Mar 2023 12:00:00 +0100</pubDate>
      <guid isPermaLink="false">https://website.com/1-post-title</guid>
      <author>John Doe</author>
    </item>
    <item>
      <title>
        <![CDATA[Post title #2]]>
      </title>
      <link>https://website.com/2-post-title</link>
      <description>
        <![CDATA[Blog post number two]]>
      </description>
      <pubDate>Wed, 8 Mar 2023 16:30:00 +0100</pubDate>
      <guid isPermaLink="false">https://website.com/2-post-title</guid>
      <author>Jane Doe</author>
    </item>
    <item>
      <title>
        <![CDATA[Post title #3]]>
      </title>
      <link>https://website.com/3-post-title</link>
      <pubDate>Wed, 1 Mar 2023 08:45:00 +0100</pubDate>
      <guid isPermaLink="false">https://website.com/3-post-title</guid>
      <enclosure length="12345" type="audio/mpeg" url="https://website.com/podcasts/example.mp3"/>
    </item>
  </channel>
</rss>
```
