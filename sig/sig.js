const canvas = document.querySelector('canvas');
const form = document.querySelector('.signature-pad-form');
const clearButton = document.querySelector('.clear-button');
const ctx = canvas.getContext('2d');
let writingMode = false;

form.addEventListener('submit', (event) => {
  event.preventDefault();
  const imageData = canvas.toDataURL();

  const headers = new Headers();
  headers.append('Content-Type', 'application/x-www-form-urlencoded');

  fetch('submit.php', {
    method: 'POST',
    headers: headers,
    body: new URLSearchParams({
      image: imageData,
      action: 'submit'
    })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    console.log('Image successfully submitted');
    clearPad();
  })
  .catch(error => {
    console.error('Error submitting image:', error);
  });
});

const clearPad = () => {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

clearButton.addEventListener('click', (event) => {
  event.preventDefault();
  clearPad();
});

const getTargetPosition = (event) => {
  const rect = event.target.getBoundingClientRect();
  return {
    x: event.clientX - rect.left,
    y: event.clientY - rect.top
  };
}

const handlePointerMove = (event) => {
  if (!writingMode) return;

  const position = getTargetPosition(event);
  ctx.lineTo(position.x, position.y);
  ctx.stroke();
}

const handlePointerUp = () => {
  writingMode = false;
}

const handlePointerDown = (event) => {
  writingMode = true;
  ctx.beginPath();

  const position = getTargetPosition(event);
  ctx.moveTo(position.x, position.y);
}
const handleTouchMove = (event) => {
  if (!writingMode) return;
  const touch = event.touches[0];
  const position = getTargetPosition(touch);
  ctx.lineTo(position.x, position.y);
  ctx.stroke();
};

const handleTouchStart = (event) => {
  writingMode = true;
  const touch = event.touches[0];
  ctx.beginPath();
  const position = getTargetPosition(touch);
  ctx.moveTo(position.x, position.y);
};

const handleTouchEnd = () => {
  writingMode = false;
};

canvas.addEventListener('touchstart', handleTouchStart, { passive: true });
canvas.addEventListener('touchend', handleTouchEnd, { passive: true });
canvas.addEventListener('touchmove', handleTouchMove, { passive: true });

ctx.lineWidth = 2.5;
ctx.lineJoin = ctx.lineCap = 'round';

canvas.addEventListener('pointerdown', handlePointerDown, { passive: true });
canvas.addEventListener('pointerup', handlePointerUp, { passive: true });
canvas.addEventListener('pointermove', handlePointerMove, { passive: true });
