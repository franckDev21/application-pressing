import './bootstrap';
import Task from './Task';

import Alpine from 'alpinejs';

// window.Alpine = Alpine;

Alpine.start();


import React from 'react';
import {createRoot}  from 'react-dom/client';


if (document.getElementById('app')) {
    createRoot(document.getElementById('app') as HTMLElement).render(<Task title='Hello' />)
}