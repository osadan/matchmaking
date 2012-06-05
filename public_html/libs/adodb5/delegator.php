/*
   Delegator class for adodb
    Copyright (C) 2007 CodeAssembly.com  

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see http://www.gnu.org/licenses/
*/

/**
 * @package DB
 * @author CodeAssembly
 *
 * Delegator class for adodb
 * USAGE :
 * 
 *
 *  $DB =  db::getInstance();
 *
 *  try
 *  {
 *      $DB -> insert('tablename',$insert_array);
 *              $rs = $DB->Execute('select * from users');
 *  }
 *  catch (exception $e)
 *  {
 *      print_r($e);
 *  }
 *
 *  while ($array = $rs->FetchRow()) {
 *      print_r($array);
 *  }
 *
 *  
 *
*/
define('ADODB_ASSOC_CASE', 2);

class db
{
        function getInstance()
        {
                if (self :: $instance === NULL)
                {
                        self :: $instance = new db(); //create class instance
                        include('adodb-exceptions.inc.php' ); //include exceptions for php5
                        include('adodb.inc.php' );

                        self :: $adodb = NewADOConnection(DB_TYPE);
                        self :: $adodb -> Connect( DB_SERVER, DB_USERNAME,DB_PASSWORD, DB_NAME ); //connect to database constants are taken from config
                        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
                }
                return  self :: $instance;
        }

        /**
         * Insert the array into table
         *
         * @param string $tablename
         * @param array $record
         *
         * Example:
         * 
         * $DB -> insert('users',array('user' => 'insert_test','name'=>'James','surname'=>'Baker','user_level' => 5));
         * $DB -> insert('users',$_POST);
         * 
         */
        function insert($tablename,$record)
        {
                
                $rs = self :: $adodb -> Execute( 'SELECT * FROM ' . $tablename . ' LIMIT 1');
                $insert_sql =  self :: $adodb -> GetInsertSQL($rs,$record);
                return self :: $adodb -> Execute( $insert_sql );
        }

        /**
         * Update table
         *
         * @param string $tablename
         * @param $record $array
         * @param integer $where
         * @return result
     *
         * Example:
         * 
         * $DB -> update('useri',array('user' => 'update_test','name'=>'James','surname'=>'Baker','phone' => 04656454),'id=75');
         * $DB -> update('users',$_POST,'id=75');
         * 
         */
        function update($tablename,$record,$where = null,$data = null)
        {
                if ( $where !== Null ) 
                {
                        $rs = self :: $adodb -> Execute( 'SELECT * FROM ' . $tablename . ' WHERE ' . $where .' LIMIT 1',$data);
                } else
                {
                        $rs = self :: $adodb -> Execute( 'SELECT * FROM ' . $tablename .' LIMIT 1',$data);
                }

                $update_sql = self :: $adodb -> GetUpdateSQL( $rs, $record );
                if ( $update_sql != '')
                {
                        return self :: $adodb -> Execute( $update_sql );
                }
                return true;
        }

        /**
         * Delete record from table
         *
         * @param string $tablename
         * @param string $where
         * @return result
         *
         * Example:
         * 
         * $DB -> delete('useri','id=75');
         * 
         */
        function delete( $tablename, $where, $params )
        {
                try 
                {
                        $result = self :: $adodb -> Execute( 'DELETE FROM '.$tablename.' WHERE '.$where , $params);
                }
                catch ( exception $e )
                {
                        if (constant( 'DEBUG' ) === true)
                        {
                                print_r($e);
                        }
                }
                return result;
        }

        /**
         * Returns a prepared query . Works just like execute , only instead of running the prepared query it returns it
         *
         * @param unknown_type $str
         * @param unknown_type $arr
         * @return unknown
         */
        public function returnPreparedQuery ( $str , $arr )
        {
                $temp = explode ( '?' , $str ) ;
                $size = count ($temp) ;
                for ($x=0;$x<$size;$x++)
                {
                        if ( ($temp[$x] != '') && ( $arr[$x]) != '' )
                        {
                                $temp[$x] .=  ' ' .  self ::$instance -> qstr ($arr[$x]) ;
                        }                       
                }
                return implode ( ' ' , $temp ) ;
        } 

        function __call($method, $args)//call adodb methods
        {
                return call_user_func_array(array(self :: $adodb, $method),$args);
        }

        function __get($property)
        {
                return self :: $adodb -> $property;
        }

        function __set($property, $value)
        {
                self :: $adodb[$property] = $value;
        }

        private function __clone()//do not allow clone
        {
        }

        static private $adodb = false;
        static private $instance = NULL;
}
?>