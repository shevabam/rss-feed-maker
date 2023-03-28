<?php

namespace RssFeedMaker;

class Feed
{
    public $title;          // Feed title
    public $link;           // Feed URL
    public $description;    // Feed description
    public $lastBuildDate;  // Feed build date ; default today's date
    public $pubDate;        // Feed pub date
    public $copyright;      // Feed copyright
    public $image;          // Feed image
    public $webmaster;      // Webmaster email contact
    public $category;       // Feed category
    public $language;       // Feed language ; default en
    public $ttl;            // Feed TTL
    public $encoding;       // Feed encoding ; default utf-8
    public $items;          // Feed items (array)
    public $customTags;     // Feed tags
    


    /**
     * 
     */
    public function __construct()
    {
        $this->items = array();
        $this->customTags = array();
        
        $this->title = '';
        $this->link = '';
        $this->description = '';
        $this->lastBuildDate = date(DATE_RSS);
        $this->pubDate = '';
        $this->copyright = '';
        $this->image = array();
        
        
        $this->webmaster = '';
        $this->category = '';
        $this->language = 'en';
        $this->ttl = 0;
        $this->encoding = 'utf-8';
    }
    

    /**
     * Set feed title
     *
     * @param string $title Feed title
     * @return Feed
     */
    public function setTitle(string $title): Feed
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set feed description
     *
     * @param string $description Feed description
     * @return Feed
     */
    public function setDescription(string $description): Feed
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set feed lastBuildDate
     *
     * @param string $date Feed lastBuildDate
     * @return Feed
     */
    public function setLastBuildDate(string $date = ''): Feed
    {
        if (empty($date))
            $this->lastBuildDate = date(DATE_RSS);
        elseif (strtotime($date) == false)
            $this->lastBuildDate = date(DATE_RSS, $date);
        else
            $this->lastBuildDate = date(DATE_RSS, strtotime($date));

        return $this;
    }

    /**
     * Set feed pubDate
     *
     * @param string $date Feed pubDate
     * @return Feed
     */
    public function setPubDate(string $date = ''): Feed
    {
        if (empty($date))
            $this->pubDate = date(DATE_RSS);
        elseif (strtotime($date) == false)
            $this->pubDate = date(DATE_RSS, $date);
        else
            $this->pubDate = date(DATE_RSS, strtotime($date));

        return $this;
    }

    /**
     * Set feed link
     *
     * @param string $link Feed URL
     * @return Feed
     */
    public function setLink(string $link): Feed
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Set feed webmaster
     *
     * @param string $webmaster Feed webmaster
     * @return Feed
     */
    public function setWebmaster(string $webmaster = ''): Feed
    {
        $this->webmaster = $webmaster;
        return $this;
    }

    /**
     * Set feed category
     *
     * @param string $category Feed category
     * @return Feed
     */
    public function setCategory(string $category = ''): Feed
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Set feed copyright
     *
     * @param string $copyright Feed copyright
     * @return Feed
     */
    public function setCopyright(string $copyright = ''): Feed
    {
        $this->copyright = $copyright;
        return $this;
    }

    /**
     * Set feed language
     * See: https://www.rssboard.org/rss-language-codes
     *
     * @param string $language Feed copyright
     * @return Feed
     */
    public function setLanguage(string $language = ''): Feed
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Set feed TTL
     *
     * @param string $ttl Feed TTL
     * @return Feed
     */
    public function setTtl(int $ttl = 60): Feed
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * Set feed image
     *  $this->setImage([
            'title' => 'Image title', 
            'url' => 'https://website.com/Image.jpg', 
            'link' => 'https://website.com', 
        ]);
     *
     * @param array $image Feed image
     * @return Feed
     */
    public function setImage(array $image = []): Feed
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Set feed encoding
     *
     * @param string $encoding Feed encoding
     * @return Feed
     */
    public function setEncoding(string $encoding = ''): Feed
    {
        $this->encoding = $encoding;
        return $this;
    }

    
    /**
     * Get feed title
     * 
     * @return string
     */
    private function _getFeedTitle(): string
    {
        return !empty($this->title) ? "<title>".$this->title."</title>\n" : "<title/>";
    }
    
    /**
     * Get feed URL
     * 
     * @return string
     */
    private function _getFeedLink(): string
    {
        return !empty($this->link) ? "<link>".$this->link."</link>\n" : "</link>";
    }
    
    /**
     * Get feed description
     * 
     * @return string
     */
    private function _getFeedDescription(): string
    {
        return !empty($this->description) ? "<description>".$this->description."</description>\n" : "<description/>";
    }
    
    /**
     * Get feed language
     * 
     * @return string
     */
    private function _getFeedLanguage(): string
    {
        return !empty($this->language) ? "<language>".$this->language."</language>\n" : "";
    }
    
    /**
     * Get feed last build date
     * 
     * @return string
     */
    private function _getFeedLastBuildDate(): string
    {
        return !empty($this->lastBuildDate) ? "<lastBuildDate>".$this->lastBuildDate."</lastBuildDate>\n" : "";
    }
    
    /**
     * Get feed pub date
     * 
     * @return string
     */
    private function _getFeedPubDate(): string
    {
        return !empty($this->pubDate) ? "<pubDate>".$this->pubDate."</pubDate>\n" : "";
    }
    
    /**
     * Get feed webmaster contact
     * 
     * @return string
     */
    private function _getFeedWebmaster(): string
    {
        return !empty($this->webmaster) ? "<webMaster>".$this->webmaster."</webMaster>\n" : "";
    }
    
    /**
     * Get feed copyright
     * 
     * @return string
     */
    private function _getFeedCopyright(): string
    {
        return !empty($this->copyright) ? "<copyright>".$this->copyright."</copyright>\n" : "";
    }
    
    /**
     * Get feed category
     * 
     * @return string
     */
    private function _getFeedCategory(): string
    {
        return !empty($this->category) ? "<category>".$this->copyright."</category>\n" : "";
    }
    
    /**
     * Get feed TTL
     * 
     * @return string
     */
    private function _getFeedTtl(): string
    {
        return !empty($this->ttl) && $this->ttl > 0 ? "<ttl>".$this->ttl."</ttl>\n" : "";
    }
    
    /**
     * Get feed image
     * 
     * @return string
     */
    private function _getFeedImage(): string
    {
        if (count($this->image) > 0)
        {
            $out  = "<image>\n";

            if (array_key_exists('title', $this->image) && !empty($this->image['title']))
                $out .= "  <title>".$this->image['title']."</title>\n";

            if (array_key_exists('url', $this->image) && !empty($this->image['url']))
                $out .= "  <url>".$this->image['url']."</url>\n";

            if (array_key_exists('link', $this->image) && !empty($this->image['link']))
                $out .= "  <link>".$this->image['link']."</link>\n";

            $out .= "</image>\n";
            
            return $out;
        }
        
        return '';
    }
    
    
    
    /**
     * Add feed item
     * 
     * @param array $item
     * @return array
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    /**
     * Create custom feed tag
     * 
     * @param string $tag
     * @param string $value
     */
    public function addCustomTag(string $tag, mixed $value)
    {
        $this->customTags[$tag] = $value;
    }
    

    /**
     * Generate Channel tag
     * 
     * @return string
     */
    public function out(): string
    {
        $out  = $this->_header();
        
        $out .= "<channel>\n";
        $out .= $this->_getFeedTitle();
        $out .= $this->_getFeedLink();
        $out .= $this->_getFeedDescription();
        $out .= $this->_getFeedLanguage();
        $out .= $this->_getFeedLastBuildDate();
        $out .= $this->_getFeedPubDate();
        $out .= $this->_getFeedWebmaster();
        $out .= $this->_getFeedCopyright();
        $out .= $this->_getFeedCategory();
        $out .= $this->_getFeedTtl();
        $out .= $this->_getFeedImage();
        
        if (count($this->customTags) > 0)
        {
            foreach ($this->customTags as $key => $val) 
                $out .= "<".$key.">".$val."</".$key.">\n";
        }
        
        if (count($this->items) > 0)
        {
            foreach ($this->items as $item)
                $out .= $item->out();
        }
        
        $out .= "</channel>\n";
        
        $out .= $this->_footer();
        
        // $out = str_replace("&", "&amp;", $out);
        
        return $out;
    }
    

    /**
     * Print XML
     * 
     * @param string $contentType
     * @return string
     */
    public function generate(string $contentType = 'application/xml')
    {
        $xml = $this->out();
        header('Content-type: '.$contentType);
        
        echo $xml;
    }
    

    /**
     * Save feed on server
     * 
     * @param string $location File location
     * @return bool
     */
    public function save(string $location)
    {
        $xml = $this->out();
        
        if (!file_exists($location))
            touch($location);

        file_put_contents($location, $xml);
    }
    

    /**
     * Generate feed header
     * 
     * @return string
     */
    private function _header(): string
    {
        $out  = '<?xml version="1.0" encoding="'.$this->encoding.'"?>'."\n";
        $out .= '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">'."\n";
        
        return $out;
    }

    /**
     * Generate feed footer
     * 
     * @return string
     */
    private function _footer(): string
    {
        return '</rss>';
    }
}