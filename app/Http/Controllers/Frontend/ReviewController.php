<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //review store
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'rating' => 'required',
            'input_text' => 'required',
        ]);
    
        // Check if the user has already submitted a review for the product
        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if ($check) {
            $notification = array('messege' => 'Already you have a review with this product !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    
        // Extract input text from the request
        $input_text = $request->input('input_text');
    
        // Log the input text
    
        try {
            // Send a POST request to the Flask app for sentiment prediction
            $response = Http::post('http://4599-34-48-72-154.ngrok-free.app/predict_sentiment', [
                'review' => $input_text,
            ]);
    
            // Decode the JSON response
            $responseData = $response->json();

            // Access the predicted sentiment from the response
            $predicted_emotion = $responseData['sentiment'];

            // Insert review data into the database
            $data = array(
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'review' => $input_text,
                'rating' => $request->rating,
                'predicted_emotion' => $predicted_emotion,
                'review_date' => date('d-m-Y'),
                'review_month' => date('F'),
                'review_year' => date('Y'),
            );
            // return response()->json(['input_text' => $data]);

            DB::table('reviews')->insert($data);
    
            // Success notification
            toastr()->success('Thank you for your review!');
            return redirect()->back();
    
        } catch (\Exception $e) {
            toastr()->error('An error occurred during prediction.');
            return back();
        }
    }

   
    public function StoreWebsiteReview(Request $request)
    {
        // Check if the user has already submitted a review
        $check = DB::table('wbreviews')->where('user_id', Auth::id())->first();
        if ($check) {
            toastr()->success('Review already exists!');
            return redirect()->back();
        }

        // Extract input text from the request
        $input_text = $request->input('input_text');

        try {
            // Send a POST request to the sentiment prediction service
            $response = Http::post('http://828d-34-82-123-227.ngrok-free.app/predict_sentiment', [
                'review' => $input_text,
            ]);

            $responseData = $response->json();
            $predicted_emotion = $responseData['sentiment'];

            $data = array(
                'user_id' => Auth::id(),
                'name' => $request->name,
                'review' => $input_text,
                'rating' => $request->rating,
                'review_date' => date('d , F Y'),
                'status' => 0,
                'predicted_emotion' => $predicted_emotion, // Save predicted emotion in the database
            );
            // return response()->json(['input_text' => $data]);

            // Insert review data into the database
            DB::table('wbreviews')->insert($data);

            toastr()->success('Thank for your review!');
            return redirect()->back();

        } catch (\Exception $e) {
            // Error handling
            toastr()->error('An error occurred during prediction.');
            return back();
        }
    }

}
