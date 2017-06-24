<?php

namespace iMega;

class Controller extends \Controller
{
    /**
     * @return \Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->registry->get('container');
    }

    /**
     * @return \Loader
     */
    public function getLoader()
    {
        return $this->load;
    }

    /**
     * @return \Event
     */
    public function getEventDispatcher()
    {
        return $this->event;
    }

    /**
     * @return \Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return \Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return \DB
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return \Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return \Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @return \Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return \Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return \Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param string $name
     * @param array  $data
     *
     * @return null
     */
    public function render($name, array $data = [])
    {
        /**
         * @var \Twig_Environment $render
         */
        $render = $this->getContainer()->offsetGet(Service::RENDER);
        return $render->render($name, $data);
        //return $this->getLoader()->view($name, $data);
    }
}
