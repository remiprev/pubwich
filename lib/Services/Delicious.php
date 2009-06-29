<?php

	class Delicious extends Service {
	
		public $username;

		public function __construct( $config ){
			$this->setURL( sprintf( 'http://feeds.delicious.com/v2/rss/%s?count=%s', $config['username'], $config['total'] ) );
			$this->username = $config['username'];

			$this->title = $config['title'];
			$this->description = $config['description'];
			$this->setItemTemplate('<li><a href="{%link%}">{%title%}</a></li>'."\n");
			$this->setURLTemplate('http://del.icio.us/'.$config['username'].'/');
			
			parent::__construct();

		}

		/**
		 * Surcharge de parent::getData()
		 *
		 * @return SimpleXMLElement
		 */
		public function getData() {
			$data = parent::getData();
			return $data->channel->item;
		}

		public function populateItemTemplate( &$item ) {
			return array(
						'link' => htmlspecialchars( $item->link ),
						'title' => SmartyPants( $item->title )
			);
		}
			
	}

