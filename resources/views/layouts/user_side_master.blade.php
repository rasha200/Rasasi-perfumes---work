{{--include first start--}}
@include("include/user_side/first")
{{--include first end--}}

{{--include header start--}}
@include("include/user_side/header")
{{--include header end--}}



@yield("content")

{{--include footer start--}}
@include("include/user_side/footer")
{{--include footer end--}}