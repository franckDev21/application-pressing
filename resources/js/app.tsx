import './bootstrap';

import Alpine from 'alpinejs';

// window.Alpine = Alpine;

Alpine.start();


import React from 'react';
import {createRoot}  from 'react-dom/client';
import Commande from './Commande/Commande';
import CommandeTable from './CommandeTable/CommandeTable';


if (document.getElementById('commande')) {
    createRoot(document.getElementById('commande') as HTMLElement).render(<Commande />)
}

if (document.getElementById('commandeEdit')) {
    const idCommande = document.getElementById('commandeEdit')?.dataset.id || '';
    
    createRoot(document.getElementById('commandeEdit') as HTMLElement).render(<Commande id={idCommande} />)
}

if (document.getElementById('CommandeTable')) {
    const idCommande = document.getElementById('CommandeTable')?.dataset.id || '';
    
    createRoot(document.getElementById('CommandeTable') as HTMLElement).render(<CommandeTable />)
}