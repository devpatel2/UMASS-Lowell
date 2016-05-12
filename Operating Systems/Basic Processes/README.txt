If your parent program receives an argument on the command-line, it must:
    Display a process information report.
    Create a unnamed pipe, using pipe.
    Spawn a child process that inherits the pipe, using fork.
    Read from the pipe (to synchronize with the child).
    Send the child a SIGTERM signal with kill.
    Wait for the child to terminate, with wait, and report the child’s exit status.
    Exit with success.

If your parent program does not receive an argument on the command-line, it must:
    Display a process information report.
    Exit with success.

Your child program must:
    Display a process information report.
    Setup a signal handler with sigaction for the SIGTERM signal that replaces the child 
        program with an instance of the parent program, without a command-line argument using execl.
    Write a message to the inherited pipe, to synchronize with its parent.
    Enter an endless loop that never returns.

test.out shows terminal output.
