<?php

namespace iMega;

class Controller extends \Controller
{
    /**
     * @return \Config
     */
    public function getConfig()
    {
        return $this->registry->config;
    }

    /**
     * @return \Loader
     */
    public function getLoader()
    {
        return $this->registry->load;
    }

    /**
     * @return \Event
     */
    public function getEventDispatcher()
    {
        return  $this->registry->event;
    }

    /**
     * @return \Request
     */
    public function getRequest()
    {
        return  $this->registry->request;
    }

    /**
     * @return \Response
     */
    public function getResponse()
    {
        return  $this->registry->response;
    }

    /**
     * @return \DB
     */
    public function getDb()
    {
        return  $this->registry->db;
    }

    /**
     * @return \Session
     */
    public function getSession()
    {
        return  $this->registry->session;
    }

    /**
     * @return \Cache
     */
    public function getCache()
    {
        return  $this->registry->cache;
    }

    /**
     * @return \Url
     */
    public function getUrl()
    {
        return  $this->registry->url;
    }

    /**
     * @return \Language
     */
    public function getLanguage()
    {
        return  $this->registry->language;
    }

    /**
     * @return \Document
     */
    public function getDocument()
    {
        return  $this->registry->document;
    }
}
