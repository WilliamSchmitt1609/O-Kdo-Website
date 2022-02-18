import AppHeader from 'src/components/AppHeader';
import Footer from 'src/components/Footer';

import gifError from 'src/assets/gifError.gif';

import './style.scss';

const Error = () => (
  <div className="content errorContent">
    <AppHeader />
    <main className="main">
      <div className="invisible-div" />
      <p>Page Erreur 404 </p>
      <img className="gif" src={gifError} alt="errorGif" />
      <p>Ce n'est pas ici que tu vas trouver le cadeau idéal !!!</p>
    </main>
    <Footer />
  </div>
);

export default Error;
