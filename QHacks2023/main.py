from kivy.properties import StringProperty
from kivy.uix.screenmanager import ScreenManager, Screen, SlideTransition
import os
from kivy.app import App
from kivy.uix.boxlayout import BoxLayout
from kivy.config import Config
from kivy.app import App
from kivy.lang import Builder
from kivy.uix.screenmanager import Screen
from kivy.uix.widget import Widget
import smtplib






class LoginScreen(Screen):
    pass
class HomeScreen(Screen):
    pass
Builder.load_file('kv/checkboxscreen.kv')
class CheckBoxScreen(Screen):
    new_line = '\n'
    checks = []
    def checkbox_click(self, instance, value, problem):
        if value == True:
            new_line = '\n'
            CheckBoxScreen.checks.append(problem)
            output = ''
            for x in CheckBoxScreen.checks:
                output = f'{output} {x} ; {new_line}'
            self.ids.output_label.text = f'This is wrong with your waste:{new_line}{output}'
            mes = self.ids.output_label.text
        else:
            new_line = '\n'
            CheckBoxScreen.checks.remove(problem)
            output = ''
            for x in CheckBoxScreen.checks:
                output = f'{output} {x} ; {new_line}'
            self.ids.output_label.text = f'This is wrong with your waste: {output}'
            mes = self.ids.output_label.text
        print(value)

    pass



GUI = Builder.load_file("main.kv")
class MainApp(App):
    def build(self):
        return GUI
    def change_screen(self, screen_name):
        screen_manager = self.root.ids['screen_manager']
        screen_manager.current = screen_name #change current screen name to other

    def submit_click(self):
        f = open("data.txt", "w")
        f.write('\n')  # overwrite previous
        f = open("data.txt", "a")
        for checks in CheckBoxScreen.checks:
            f.write(checks)
            f.write('\n')
        f.close()
        str = ''
        for check in CheckBoxScreen.checks:
            str += check
            str += '\n'
        server = smtplib.SMTP('smtp.gmail.com', 587)
        # start the server connection
        server.starttls()
        # login to the server using your email and password
        server.login("ethney@cyberstewart.com", "******")
        to_email = "emilyemilyjiang@outlook.com"
        subject = 'This is wrong with your waste:'
        message = subject + str
        server.sendmail("ethney@cyberstewart.com", to_email, message)
        # close the server connection
        server.quit()





if __name__ == '__main__':
    MainApp().run()
