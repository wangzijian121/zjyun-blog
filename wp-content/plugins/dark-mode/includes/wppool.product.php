<?php

/**
 * @WPPool Product 
 * @author 		WPPool.dev
 * @version 	2.0.0 
 */

namespace WPPOOL;

/**
 * Check ABSOLUTE PATH 
 */

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Product Class
 */
if (!class_exists('\WPPool\Product')) :

    final class Product
    { 
        # product name 
        protected $product = 'wp_dark_mode';

        # Fluent API URL
        protected $fluent_api_url = 'https://fluent.wppool.dev/wp-json/contact/sync';
        protected $fluent_api_key = '66E6D9A59A5A948B';

        # Promotional offer sheet URL
        protected $offer_sheet_url = 'https://docs.google.com/spreadsheets/export?format=csv&id=1D9ULWJj0f1mnXAE2rCwbVsDcKBTBpohPv9CarLOMJbo&gid=0';

        /**
         * Tag IDs
         */
        protected $tagIds = [
            'free' => 11,
            'paid' => 12,
            'pro' => 13,
            'ultimate' => 14,
            'lifetime' => 15,
            'cancelled' => 23,
        ];

        /**
         * List IDs
         */
        protected $listIds =  [
            "WP Markdown Editor" => 19,
            "WP Dark Mode" => 20,
            "Sheets To WP Table Live Sync" => 21,
            "Easy Video Reviews" => 22,
            "Jitsi Meet" => 23,
            "Zero BS Accounting" => 24,
            "Stock Sync for WooCommerce with Google SheetSystem for WooCommerce" => 46,
            "Stock Notifier for WooCommerce" => 47,
            "Chat Widgets for Multivendor Marketplaces" => 26,
            "Social Contact Form" => 49,
            "Elementor Speed Optimizer" => 54,
        ];

        # Custom tag 
        protected $custom_tag = null;

        # Custom list 
        protected $custom_list = null;

        /**
         * Set custom tag 
         */
        public function setTag($tag = null)
        {
            if ($tag) {
                $this->custom_tag = $tag;
            }

            return $this;
        }

        /**
         * Set custom list 
         */
        public function setList($list = null)
        {
            if ($list) {
                $this->custom_list = $list;
            }

            return $this;
        }

        # Forced tags and lists
        protected function sanitize_product_name($product = 'WP Dark Mode')
        {
            $product = strtolower($product);
            $product = sanitize_title($product);
            $product = str_replace('-', '_', $product);
            $product = str_replace('__', '_', $product);
            return $product;
        }

        /**
         * Constructor
         */
        public function __construct($product = 'wp_dark_mode')
        {
            $product = $this->sanitize_product_name($product);
            $this->product = $product;
        }

        /**
         * Get Lists
         */
        public function get_lists($product_name = null)
        {
            $lists = $this->listIds;
            // sanitize all keys of the array 

            if ($lists && is_array($lists)) {
                $new_lists = [];
                foreach ($lists as $key => $value) {
                    $new_lists[$this->sanitize_product_name($key)] = $value;
                }
            }

            // return all lists 
            if ($product_name === null) {
                return $new_lists;
            }

            // return only specific list 
            $product_name = $this->sanitize_product_name($product_name);
            if (array_key_exists($product_name, $new_lists)) {
                return $new_lists[$product_name];
            }

            return false;
        }

        /**
         * Get current list ID 
         */
        public function get_list_id($product_name = null)
        {
            if ($this->custom_list) {
                return $this->custom_list;
            }

            if ($product_name === null) {
                return $this->get_lists($this->product);
            }
            return $this->get_lists($product_name);
        }

        /**
         * Get current tag ID 
         */
        public function get_tag_id($tag = 'free')
        {
            if ($this->custom_tag) {
                return $this->custom_tag;
            }
            return $this->tagIds[$tag] ?? false;
        }


        /**
         * Sync contact to Fluent CRM
         */
        public function sync_contact($data = [])
        {

            if (!$data || !is_array($data)) {
                return false;
            }

            // return $data;

            $response = wp_remote_post($this->fluent_api_url, [
                'method' => 'POST',
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->fluent_api_key,
                ],
                'body' => $data,
            ]);

            if (is_wp_error($response)) {
                // throw new \Exception($response->get_error_message());
                return $response;
            }

            $response_body = json_decode(wp_remote_retrieve_body($response), true);

            return $response_body;
        }

        /**
         * Subscribe email to the list
         */
        public function subscribe(array $data = null, $tag = 'free', $force = false)
        {

            /**
             * If no data passed
             */
            if (!$data || !is_array($data)) {
                return false;
            }

            /**
             * Initialize Tag ID
             */
            $tagId = $this->get_tag_id($tag);

            if ($tagId) {
                $data['tags'] = is_array($tagId) ? $tagId : [$tagId];
            }

            /**
             * Initialize List ID
             */

            $listId = $this->get_list_id();
            if ($listId) {
                $data['lists'] = is_array($listId) ? $listId : [$listId];
            }

            /**
             *  Force operation
             */
            if ($force === true) {
                $data['status'] = 'subscribed';

                if (!isset($data['remove_tags'])) {
                    $data['remove_tags'] =  [$tagId];
                }
            }

            try {
                $response = $this->sync_contact($data);

                if ($response && isset($response['success'])) {
                    return $response['success'] ?? false;
                }

                return false;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        /**
         * Subscribe email to the list
         */
        public function subscribe_free($data)
        {
            return $this->subscribe($data, 'free');
        }

        /**
         * Subscribe email to the list
         */
        public function subscribe_pro($data)
        {
            return $this->subscribe($data, 'pro');
        }

        /**
         * Unsubscribe email from the Fluent CRM
         */
        public function unsubscribe_system($data)
        {
            $data['status'] = 'unsubscribed';
            return $this->sync_contact($data);
        }

        /**
         * Unsubscribe email from the list
         */
        public function unsubscribe($data)
        {
            if ($this->get_list_id) {
                $data['remove_lists'] = [$this->get_list_id()];
            }
            return $this->sync_contact($data);
        }

        /**
         * Get promotional offers from Google Sheet 
         */
        public function offer()
        {
            # Get transient data if available
            $data = get_transient('wppool_offer_data');
            $product = $this->product;


            # get data from sheet 
            if (!$data) {

                $response = wp_remote_get($this->offer_sheet_url);

                if (!is_wp_error($response)) {

                    $response = wp_remote_retrieve_body($response);

                    if (!empty($response)) {

                        $csv = array_map('str_getcsv', explode("\n", $response));
                        $data = [];
                        for ($i = 1; $i < count($csv); $i++) {
                            if (!empty($csv[$i][0])) {
                                $data[$i] = array_combine($csv[0], $csv[$i]);
                            }
                        }

                        # updates every hour
                        set_transient('wppool_offer_data', $data, HOUR_IN_SECONDS);
                    }
                } else {
                    $data = false;
                }
            }

            # return only the data for the current product
            if ($data && $product) {
                $data = array_filter($data, function ($item) use ($product) {
                    return $this->sanitize_product_name($item['plugin']) == $product;
                });

                if (!empty($data)) {
                    $data = array_values($data)[0];
                } else {
                    $data = false;
                }
            }

            return $data;
        }
    }

endif;
 
