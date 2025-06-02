function postTweet() {

    let tweetText = document.getElementById("content").value;

    if (tweetText.trim() === "") return;

    let tweetContainer = document.getElementById("tweetContainer");

    let tweetDiv = document.createElement("div");

    tweetDiv.classList.add("tweet-wrapper");

    tweetContainer.prepend(tweetDiv);
    document.getElementById("tweetInput").value = "";
  }

 



