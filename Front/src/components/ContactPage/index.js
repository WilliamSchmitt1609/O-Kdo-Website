import AppHeader from 'src/components/AppHeader';
import DevCard from 'src/components/ContactPage/DevCard';
import Footer from 'src/components/Footer';

import team from 'src/staticDatas/team';

import './style.scss';

const ContactPage = () => (
  <div className="content contactPage">
    <AppHeader />
    <main className="main">
      <div className="invisible-div" />
      <div className="devList">
        <h1 className="devCard-title"> L'équipe O'Kdo</h1>
        {team.map((item) => (
          <DevCard key={item.name} {...item} />
        ))}
      </div>
    </main>
    <Footer />
  </div>
);

export default ContactPage;
