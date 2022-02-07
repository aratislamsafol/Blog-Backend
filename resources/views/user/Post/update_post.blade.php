<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Post</title>
</head>
<body>
    <h5 style="text-align: center; padding:30px">Post Edit</h5>

    <div class="card-group" style="padding:10px">
        <div class="card">

          <div class="card-body">
            <h4>Comment</h4>
            <div class="form-floating">

                <form action="{{route('comment.update',$get_edit_id->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="post_id_get" value="{{$get_edit_id->post_id}}">
                    <textarea class="form-control" name="comment_text" value="{{$get_edit_id->comment_text}}" id="floatingTextarea"></textarea>
                    <button type="submit" class="mt-3">Save</button>
                </form>
            </div>
          </div>

            {{-- @php
                $comment=App\Comment::where('post_id',$row->id)->where('user_id',Auth::user()->id)->latest()->get();
            @endphp --}}
            {{-- <form action="{{route('comment.update',$get_edit_id->id)}}" method="post">
                @csrf
                <input type="text" name="comment_text" value="{{$get_edit_id->comment_text}}">
                <button type="submit">Update</button>
            </form> --}}

    </div>


      <!-- Latest compiled and minified JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
