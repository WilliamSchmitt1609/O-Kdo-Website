import AppHeader from 'src/components/AppHeader';
import Footer from 'src/components/Footer';
import Form from 'src/components/Home/Form';

// import { useSelector } from 'react-redux';

import './style.scss';

const Home = () => (
  <div className="content homeContent">
    <AppHeader />
    <div className="invisible-div" />
    <main className="main">
      <Form className="formContent" />
    </main>
    <Footer />
  </div>
);

export default Home;
