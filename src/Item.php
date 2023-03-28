<?php

namespace RssFeedMaker;

class Item
{
    public $title;        // Item title
    public $link;         // Item link
    public $description;  // Item description
    public $author;       // Item author
    public $category;     // Item category
    public $pubDate;      // Item publish date
    public $guid;         // Item GUID
    public $source;       // Item source
    public $comments;     // Item URL for comments
    public $customTags;   // Item custom tags
    public $enclosure;    // Item enclosure

    /**
     * 
     */
    public function __construct()
    { 
        $this->title       = '';
        $this->link        = '';
        $this->description = '';
        $this->author      = '';
        $this->category    = '';
        $this->pubDate     = '';
        $this->guid        = '';
        $this->source      = [];
        $this->comments    = '';
        $this->customTags  = [];
        $this->enclosure   = [];
    }
    

    /**
     * Set item title
     *
     * @param string $title Item title
     * @return Item
     */
    public function setTitle(string $title = ''): Item
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set item description
     *
     * @param string $description Item description
     * @return Item
     */
    public function setDescription(string $description = ''): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set item link
     *
     * @param string $link Item URL
     * @return Item
     */
    public function setLink(string $link = ''): Item
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Set item author
     *
     * @param string $author Item author
     * @return Item
     */
    public function setAuthor(string $author = ''): Item
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Set item category
     *
     * @param string $category Item category
     * @return Item
     */
    public function setCategory(string $category = ''): Item
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Set item pubDate
     *
     * @param string $date Item pubDate
     * @return Item
     */
    public function setPubDate(string $date = ''): Item
    {
        if (empty($date))
            $this->pubDate = date(DATE_RSS);
        elseif (strtotime($date) == false)
            $this->pubDate = date("D, j M Y H:i:s O", $date);
        else
            $this->pubDate = date("D, j M Y H:i:s O", strtotime($date));

        return $this;
    }

    /**
     * Set item GUID
     *
     * @param string $guid Item GUID
     * @return Item
     */
    public function setGuid(string $guid = ''): Item
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * Set item source
     *   $Item->setSource(['url' => 'https://...', 'source' => 'John Doe']);
     *
     * @param array $source Item source
     * @return Item
     */
    public function setSource(array $source = []): Item
    {
        $this->source = $source;
        return $this;
    }

    /**
     * Set item comments
     *
     * @param string $guid Item comments
     * @return Item
     */
    public function setComments(string $comments = ''): Item
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * Set item enclosure
     *   $Item->setEnclosure(['url' => 'https://...', 'length' => '31231', 'type' => 'image/png']);
     *
     * @param array $enclosure Item enclosure
     * @return Item
     */
    public function setEnclosure(array $enclosure = []): Item
    {
        $this->enclosure = $enclosure;
        return $this;
    }

    
    /**
     * Get item title
     * 
     * @return  string
     */
    private function _getItemTitle(): string
    {
        return !empty($this->title) ? "<title><![CDATA[".$this->title."]]></title>\n" : "<title/>";
    }
    
    /**
     * Get item link
     * 
     * @return  string
     */
    private function _getItemLink(): string
    {
        return !empty($this->link) ? "<link>".$this->link."</link>\n" : "<link/>";
    }
    
    /**
     * Get item comments
     * 
     * @return  string
     */
    private function _getItemComments(): string
    {
        return !empty($this->comments) ? "<comments>".$this->comments."</comments>\n" : "";
    }
    
    /**
     * Get item description
     * 
     * @return  string
     */
    private function _getItemDescription(): string
    {
        return !empty($this->description) ? "<description><![CDATA[".$this->description."]]></description>\n" : "<description/>";
    }
    
    /**
     * Get item date
     * 
     * @return  string
     */
    private function _getItemPubDate(): string
    {
        return !empty($this->pubDate) ? "<pubDate>".$this->pubDate."</pubDate>\n" : "<pubDate>".date(DATE_RSS)."</pubDate>\n";
    }
    
    /**
     * Get item Guid
     * 
     * @return  string
     */
    private function _getItemGuid(): string
    {
        return !empty($this->guid) ? "<guid isPermaLink=\"false\">".$this->guid."</guid>\n" : "<guid isPermaLink=\"false\">".$this->link."</guid>\n";
    }
    
    /**
     * Get item author
     * 
     * @return  string
     */
    private function _getItemAuthor(): string
    {
        return !empty($this->author) ? "<author>".$this->author."</author>\n" : "";
    }
    
    /**
     * Get item category
     * 
     * @return  string
     */
    private function _getItemCategory(): string
    {
        return !empty($this->category) ? "<category>".$this->category."</category>\n" : "";
    }
    
    /**
     * Get item source
     * 
     * @return string
     */
    private function _getItemSource(): string
    {
        return !empty($this->source) ? "<source url=\"".$this->source['url']."\">".$this->source['source']."</source>\n" : "";
    }

    /**
     * Get item enclosure
     *
     * @return string
     */
    private function _getItemEnclosure(): string
    {
        $url = $length = $type = '';

        if (isset($this->enclosure['url']))
            $url = $this->enclosure['url'];
        if (isset($this->enclosure['length']))
            $length = $this->enclosure['length'];
        if (isset($this->enclosure['type']))
            $type = $this->enclosure['type'];

        if (empty($url) && empty($length) && empty($type))
            return "";
        else
            return "<enclosure url=\"".$url."\" length=\"".$length."\" type=\"".$type."\" />";
    }
    
    
    /**
     * 
     * 
     * @param string $tag
     * @param string $value
     * @return void
     */
    public function addCustomTag(string $tag, mixed $value)
    {
        $this->customTags[$tag] = $value;
    }


    /**
     * Generate Item tag
     * 
     * @return string
     */
    public function out(): string
    {
        $out  = "<item>\n";
        
        $out .= $this->_getItemTitle();
        $out .= $this->_getItemLink();
        $out .= $this->_getItemComments();
        $out .= $this->_getItemDescription();
        $out .= $this->_getItemPubDate();
        $out .= $this->_getItemGuid();
        $out .= $this->_getItemAuthor();
        $out .= $this->_getItemCategory();
        $out .= $this->_getItemSource();
        $out .= $this->_getItemEnclosure();
        
        
        foreach ($this->customTags as $key => $val)
            $out .= "  <".$key.">".$val."</".$key.">\n";
        
        $out .= "</item>\n";
        
        return $out;
    }
}