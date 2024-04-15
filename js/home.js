const video = document.getElementById('parallax-video');
		const videoContainer = document.querySelector('.video-container');

		window.addEventListener('scroll', () => {
			let scroll = window.pageYOffset;
			let videoPosition = videoContainer.getBoundingClientRect();
 
			video.style.top = `${50 + scroll * 0.1}%`; 
		});