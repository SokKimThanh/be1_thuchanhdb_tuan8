<?php
class Product
{
        private/* int */$id;
        private/* varchar */ $name;
        private/* int */$manu_id;
        private/* int */ $type_id;
        private/* int */ $price;
        private/* varchar */ $pro_image;
        private/* text */ $description;
        private/* tinyint */ $feature;
        private/* date */ $created_at;

        public function __construct($id = 0, $name = "", $manu_id = 0, $type_id = 0, $price = 0, $pro_image = "", $description = "", $feature = "", $created_at = "")
        {
                $this->id = $id;
                $this->name = $name;
                $this->manu_id = $manu_id;
                $this->type_id = $type_id;
                $this->price = $price;
                $this->pro_image = $pro_image;
                $this->description = $description;
                $this->feature = $feature;
                $this->created_at = $created_at;
        }

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of name
         */
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of manu_id
         */
        public function getManu_id()
        {
                return $this->manu_id;
        }

        /**
         * Set the value of manu_id
         *
         * @return  self
         */
        public function setManu_id($manu_id)
        {
                $this->manu_id = $manu_id;

                return $this;
        }

        /**
         * Get the value of type_id
         */
        public function getType_id()
        {
                return $this->type_id;
        }

        /**
         * Set the value of type_id
         *
         * @return  self
         */
        public function setType_id($type_id)
        {
                $this->type_id = $type_id;

                return $this;
        }

        /**
         * Get the value of price
         */
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */
        public function setPrice($price)
        {
                $this->price = $price;

                return $this;
        }

        /**
         * Get the value of pro_image
         */
        public function getPro_image()
        {
                return $this->pro_image;
        }

        /**
         * Set the value of pro_image
         *
         * @return  self
         */
        public function setPro_image($pro_image)
        {
                $this->pro_image = $pro_image;

                return $this;
        }

        /**
         * Get the value of description
         */
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of feature
         */
        public function getFeature()
        {
                return $this->feature;
        }

        /**
         * Set the value of feature
         *
         * @return  self
         */
        public function setFeature($feature)
        {
                $this->feature = $feature;

                return $this;
        }

        /**
         * Get the value of created_at
         */
        public function getCreated_at()
        {
                return $this->created_at;
        }

        /**
         * Set the value of created_at
         *
         * @return  self
         */
        public function setCreated_at($created_at)
        {
                $this->created_at = $created_at;

                return $this;
        }

        public function __toString()
        {
                return $this->id . " " . $this->name . " ";
        }
}
//test product

// $product = new Product(100001, "san pham 1", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1, DateTime::createFromFormat("Y-m-d", "2023-4-5"));
// echo $product->__toString();
