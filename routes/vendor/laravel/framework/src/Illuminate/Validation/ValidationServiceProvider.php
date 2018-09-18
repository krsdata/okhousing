<?php

namespace Illuminate\Validation;
use DB;
use Request;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPresenceVerifier();

        $this->registerValidationFactory();
    }

    /**
     * Register the validation factory.
     *
     * @return void
     */
    protected function registerValidationFactory()
    {
        $this->app->singleton('validator', function ($app) {
            $validator = new Factory($app['translator'], $app);

            // The validation presence verifier is responsible for determining the existence of
            // values in a given data collection which is typically a relational database or
            // other persistent data stores. It is used to check for "uniqueness" as well.
            if (isset($app['db'], $app['validation.presence'])) {
                $validator->setPresenceVerifier($app['validation.presence']);
            }

            return $validator;
        });
    }

    /**
     * Register the database presence verifier.
     *
     * @return void
     */
    protected function registerPresenceVerifier()
    {
        $this->app->singleton('validation.presence', function ($app) {
            return new DatabasePresenceVerifier($app['db']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'validator', 'validation.presence',
        ];
    }

    public function boot()
    {
        $this->app['validator']->extend('composite_unique', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();
        // remove whitespaces
        $parameters = array_map( 'trim', $parameters );

        // remove first parameter and assume it is the table name
        $table = array_shift( $parameters );
        
        // start building the query
        $query = DB::table($table )->select('*');
        if(isset($data['id']))
        {
             $query->where( 'id','!=', $data['id'] );
        }
       
        $query->where( 'slider_element_id',$data['slider_element_id'] );
        $query->where( 'slider_element_type',$data['slider_element_type']  );
        $result = $query->count();
        if($result == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        return !empty( $result ); // true if no result was found

       
    });


        $this->app['validator']->extend('unique_record', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();
        // remove whitespaces
        $parameters = array_map( 'trim', $parameters );

        // remove first parameter and assume it is the table name
        $table = array_shift( $parameters );
        
        // start building the query
        $query = DB::table($table )->select('*');
        if(isset($data['id']))
        {
             $query->where( 'id','!=', $data['id'] );
              $query->where( 'parent_id','!=', $data['id'] );
        }
       
        $query->where( 'title',$data['title_en'] );
        $query->where( 'link',$data['link']  );
        $result = $query->count();

        //dd(DB::getQueryLog());
        if($result == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        return !empty( $result ); // true if no result was found

       
    });

    $this->app['validator']->extend('ProperDate', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();

        $Datetime = explode("-",$data['Datetime']);
        $start= date('Y-m-d H:i:s',strtotime(trim($Datetime[0])));
        $end= date('Y-m-d H:i:s',strtotime(trim($Datetime[1])));
        if($start < $end )
        {
            return true;
        }
        else
        {
            return false;
        }
        
    });
        


    $this->app['validator']->extend('category_composite_unique', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();

       
        // remove whitespaces
        $parameters = array_map( 'trim', $parameters );

        // remove first parameter and assume it is the table name
        $table = array_shift( $parameters );
        
        // start building the query
        $query = DB::table($table )->select('*');
        if(isset($data['id']))
        {
             $query->where( 'id','!=', $data['id'] );
        }
       
        $query->where( 'master_category_id',$data['CategoryType'] );
        $query->where( 'name',$data['name_en'] );
         $query->where( 'language_id',$data['language_en'] );
        $result = $query->count();

        //dd(DB::getQueryLog());

        
        if($result == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        return !empty( $result ); // true if no result was found

       
    });




        $this->app['validator']->extend('featured_composite_unique', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();

        //dd($data);
        // remove whitespaces
        $parameters = array_map( 'trim', $parameters );

        // remove first parameter and assume it is the table name
        $table = array_shift( $parameters );
        
        // start building the query
        $query = DB::table($table)->where( 'property_id','=', $data['property_id'] );
         if(isset($data['id']))
        {
             $query->where( 'id','!=', $data['id'] );
        }
        $result = $query->count();

         if($result == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
      
       
    });



        $this->app['validator']->extend('unique_neighbour', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();

        // remove whitespaces
        $parameters = array_map( 'trim', $parameters );

        // remove first parameter and assume it is the table name
        $table = array_shift( $parameters );
        
        // start building the query
        $query = DB::table($table)->where( 'name','=', $data['name_en'] );
         if(isset($data['id']))
        {
             $query->where( 'id','!=', $data['id'] );
        }
          $query->where( 'language_id',$data['language_en'] );
        $query->whereNull('deleted_at');
        $result = $query->count();
        
         if($result == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
      
       
    });



        $this->app['validator']->extend('unique_land_unit', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();

        // remove whitespaces
        $parameters = array_map( 'trim', $parameters );

        // remove first parameter and assume it is the table name
        $table = array_shift( $parameters );
        
        // start building the query
        $query = DB::table($table)->where( 'land_unit','=', $data['unit_en'] );
         if(isset($data['id']))
        {
             $query->where( 'id','!=', $data['id'] );
        }
          $query->where( 'language_id',$data['language_en'] );
        $query->whereNull('deleted_at');
        $result = $query->count();
        
         if($result == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
      
       
    });


         $this->app['validator']->extend('unique_building_unit', function ($attribute, $value, $parameters, $validator) {

        // data being validated
        DB::enableQueryLog();
        
         // data being validated
        $data = $validator->getData();

        // remove whitespaces
        $parameters = array_map( 'trim', $parameters );

        // remove first parameter and assume it is the table name
        $table = array_shift( $parameters );
        
        // start building the query
        $query = DB::table($table)->where( 'unit','=', $data['unit_en'] );
         if(isset($data['id']))
        {
             $query->where( 'id','!=', $data['id'] );
        }
          $query->where( 'language_id',$data['language_en'] );
        $query->whereNull('deleted_at');
        $result = $query->count();
        
         if($result == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
      
       
    });

        
            }
}
